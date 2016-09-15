<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Aws\MachineLearning\MachineLearningClient;
use Aws\MachineLearning\Exception\MachineLearningException;

class PredictionController extends Controller
{
    private $client;

    public function doView()
    {
        return view('prediction.prediction');
    }

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

    private function createEndpoint($MLModelId)
    {
        $client = $this->connectToML();
        try {
            $result = $client->createRealtimeEndpoint([
                'MLModelId' => $MLModelId
            ]);
        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        return $result;
    }

    private function deleteEndpoint($MLModelId)
    {
        try {
            $result = $this->client->deleteRealtimeEndpoint([
                'MLModelId' => $MLModelId,
            ]);
        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function doPredict(Request $request)
    {
        $this->validate($request, [
            'country' => 'required|string',
            'ml_model_id' => 'required',
            'strings_count' => 'required|integer',
            'members_count' => 'required|integer',
            'projects_count' => 'required|integer',
            'email_custom_domain' => 'required|integer',
            'has_private_project' => 'required|integer',
            'days_after_last_login' => 'required|integer',
            'same_email_domain_count' => 'required|integer',
            'same_login_and_project_name' => 'required|integer',
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

        $endPoint = $this->createEndpoint($MLModelId);

        $endpointStatus  = $endPoint["RealtimeEndpointInfo"]["EndpointStatus"];
        $predictEndpoint = $endPoint["RealtimeEndpointInfo"]["EndpointUrl"];

        if ($endpointStatus != 'READY') {
            $status = 'Updating';
            return $status;
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
            } catch (MachineLearningException $e) {
                echo $e->getMessage() . "\n";
            }

            $predictedLabel = $result["Prediction"]["predictedLabel"];
            $predict = $predictedLabel == 1 ? "Yes" : "No";

            $output = "<section class='pred-data'><h4><strong>Purchase: </strong>" . $predict . "</h4></section>";

            $this->deleteEndpoint($MLModelId);

            return $output;
        }
    }
}
