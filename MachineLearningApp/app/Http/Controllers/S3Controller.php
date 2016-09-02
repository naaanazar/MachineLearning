<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Library\Pagination\Pagination as S3Pagination;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3Controller extends Controller
{
    public $bucket = 'ml-datasets-test';

    public function predictionForm()
    {
        return view('prediction.prediction');
    }

    private function connect()
    {
        $s3 = new S3Client([
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
            ]
        ]);

        return $s3;
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $storagePath = storage_path('app/uploads');
        $file->move($storagePath, $fileName);

        $filepath = $storagePath . '/' . $fileName;
        $keyname = basename($filepath);
        $client = $this->connect();

        try {
            $result = $client->putObject(array(
                'Bucket' => $this->bucket,
                'Key'    => $keyname,
                'SourceFile'   => $filepath,
                'ACL'    => 'public-read'
            ));

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return redirect('s3/list')->with('status', '<strong>Success!</strong> File successfully uploaded to S3');
    }

    public function delete($filename)
    {
        $client = $this->connect();

        try {
            $client->deleteObject([
                'Bucket' => $this->bucket,
                'Key' => $filename,
                'RequestPayer' => 'requester'
            ]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return back();
    }

    public function listS3()
    {
        $client = $this->connect();

        try {
            $result = $client->listObjects([
                'Bucket' => $this->bucket,
                'Delimiter' => '|'
            ]);

            $results = $result['Contents'];

            $paginatedSearchResults = (new S3Pagination())->createPagination($results, 5, 's3/list');

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return view('s3.list', ['results' => $paginatedSearchResults]);
    }
}
