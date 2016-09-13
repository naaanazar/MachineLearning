<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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

    public function fileUpload($request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $storagePath = storage_path('app/');
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
        $file = $fileName;
        Storage::delete($fileName);

        return $file;
    }

    public function upload(Request $request)
    {
        $this->fileUpload($request);
        return redirect('s3/list');
    }

    public function delete()
    {
        $filename = $_POST['name'];
        $client = $this->connect();
        $filename = urldecode($filename);    

        try {
            $result = $client->deleteObject([
                'Bucket' => $this->bucket,
                'Key' => $filename,
                'RequestPayer' => 'requester'
            ]);
        } catch (S3Exception $e) {
            return  Response()->json(['success' => (array)$e->getMessage()]);
        }

       return Response()->json(['success' => (array)$result]);
    }

    public function listS3()
    {
        $client = $this->connect();

        try {
            $result = $client->listObjects([
                'Bucket' => $this->bucket,
                
            ]);

            $results = $result['Contents'];

            $paginatedSearchResults = (new S3Pagination())->createPagination($results, 6, '/s3/list/');

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return view('s3.list', ['results' => $paginatedSearchResults]);
    }

    public function ListObjectsS3()
    {
        $client = $this->connect();

        try {
            $result = $client->listObjects([
                'Bucket' => $this->bucket,
                
            ]);

            $results = $result['Contents'];

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        
        return $results;
    }

    public function getFile()
    {
        $client = $this->connect();
        $path = storage_path('app/');
        $fileName = $path . 'dY11.tx';
        try {
            $result = $client->getObject([
                'Bucket' => $this->bucket, // REQUIRED
                'Key' => 'batch.csv',
                'SaveAs' => $fileName,

            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        sleep(1);

        return response()->download($fileName);
        File::delete($fileName);
    }

    public function del()
    {
        $path = storage_path('app/');
        $fileName = $path . 'dY43.tx';

        $k = Storage::delete('dY43.tx');
        echo $k;
    }


}
