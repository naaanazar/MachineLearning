<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Aws\MachineLearning\MachineLearningClient;
use Aws\MachineLearning\Exception\MachineLearningException;

class PredictionController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = $this->connectToML();
    }

    private function connectToML()
    {
        $ml = new MachineLearningClient([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
            ]
        ]);

        return $ml;
    }

    public function doView()
    {
        return view('prediction.prediction');
    }

    private function createEndpoint($MLModelId)
    {
        $client = $this->connectToML();

        try {
            $status = true;
            $result = $client->createRealtimeEndpoint([
                'MLModelId' => $MLModelId
            ]);
        } catch (MachineLearningException $e) {
            $status = false;
            $result = $e->getMessage();
        }

        return response(['status' => $status, 'result' => $result]);
    }

    private function deleteEndpoint($MLModelId)
    {
        try {
            $status = true;
            $result = $this->client->deleteRealtimeEndpoint([
                'MLModelId' => $MLModelId,
            ]);
        } catch (MachineLearningException $e) {
            $status = false;
            $result =  $e->getMessage();
        }

        return response(['status' => $status, 'result' => $result]);
    }

    public function doPredict(Request $request)
    {
        $this->validate($request, [
            'country' => 'string|max:60',
            'ml_model_id' => 'required',
            'strings_count' => 'integer|min:0|max:10000000000',
            'members_count' => 'integer|min:0|max:10000000000',
            'projects_count' => 'integer|min:0|max:10000000000',
            'email_custom_domain' => 'integer|digits_between:0,1',
            'has_private_project' => 'integer|digits_between:0,1',
            'days_after_last_login' => 'integer|min:0|max:10000000000',
            'same_email_domain_count' => 'integer|min:0|max:10000000000',
            'same_login_and_project_name' => 'integer|digits_between:0,1',
        ]);

        $country = $request->input('country');
        $MLModelId = $request->input('ml_model_id');
        $stringsCount = $request->input('strings_count');
        $membersCount = $request->input('members_count');
        $projectCount = $request->input('projects_count');
        $emailCustomDomain = $request->input('email_custom_domain');
        $hasPrivateProject = $request->input('has_private_project');
        $daysAfterLastLogin = $request->input('days_after_last_login');
        $sameEmailDomainCount = $request->input('same_email_domain_count');
        $sameLoginAndProjectName = $request->input('same_login_and_project_name');

        $createEndPoint = $this->createEndpoint($MLModelId);
        $endPointData = $createEndPoint->original;
        $endPointStatus = $endPointData["status"];

        if (!$endPointStatus) {
            $status = false;
            $result = "Endpoint is not created! Try again!";

            return response()->json(["status" => $status, "result" => $result]);
        }

        $endPointResult = $endPointData["result"];
        $endpointStatus = $endPointResult["RealtimeEndpointInfo"]["EndpointStatus"];
        $predictEndpoint = $endPointResult["RealtimeEndpointInfo"]["EndpointUrl"];

        if ($endpointStatus != 'READY') {
            $status = false;

            return response()->json(["status" => $status]);
        } else {
            try {
                $result = $this->client->predict([
                    'MLModelId'       => $MLModelId,
                    'PredictEndpoint' => $predictEndpoint,
                    'Record' => [
                        "country" => $country,
                        "members_count" => $membersCount,
                        "strings_count" => $stringsCount,
                        "projects_count" => $projectCount,
                        "has_private_project" => $hasPrivateProject,
                        "email_custom_domain" => $emailCustomDomain,
                        "days_after_last_login" => $daysAfterLastLogin,
                        "same_email_domain_count" => $sameEmailDomainCount,
                        "same_login_and_project_name" => $sameLoginAndProjectName,
                    ]
                ]);

                $status = true;
                $result = $result["Prediction"];
            } catch (MachineLearningException $e) {
                $status = false;
                $result = "Fail prediction! Try again!";
            }

            $this->deleteEndpoint($MLModelId);

            return response()->json(["status" => $status, "result" => $result]);
        }
    }
}
