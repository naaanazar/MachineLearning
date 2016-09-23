<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class S3Controller extends Controller
{

    public $s3;

    private $client;

    public $bucket = 'ml-datasets-test';

    public function __construct()
    {
        $this->client = $this->connect();
    }


    public function doIndex()
    {
        return view('s3.list');
    }


    private function connect()
    {
        $s3 = new S3Client([
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => getenv('ML_KEY'),
                'secret' => getenv('ML_SECRET')
            ]
        ]);

        return $s3;
    }


    public function doListOfBuckets()
    {
        try {
            $result = $this->client->listBuckets([]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return view('s3.list', ['results' => $result['Buckets']]);
    }


    public function allBuckets()
    {
        try {
            $result = $this->client->listBuckets([]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['Buckets'];
    }


    public function bucketStruct()
    {
        $this->client->registerStreamWrapper();
        $buckets = $this->allBuckets();
        $files   = [];

        //foreach ($buckets as $bucket) {
           // $dir      = 's3://' . $bucket['Name'];
            $dir      = 's3://' . $this->bucket;
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

            try {
                foreach ($iterator as $file) {
                    $files[] = [
                        'name'      => $file->getBasename(),
                        'extension' => $file->getExtension(),
                        'path'      => $file->getPath(),
                        'size'      => $file->getSize(),
                        'fileType'  => $file->getType(),
                        'create'    => $file->getCTime(),
                        'modified'  => $file->getMTime()
                    ];
                }
            } catch (S3Exception $e) {
                return Response()->json($e->getMessage());
            }
      //  };

        return response()->json($files);
    }


    public function doCreateBucket(Request $request)
    {

        try {
            $this->client->createBucket([
                'ACL'                       => 'public-read-write',
                'Bucket'                    => $request->nameBucket,
                'CreateBucketConfiguration' => [
                    'LocationConstraint' => 'us-east-1',
                ],
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return back();
    }


    public function doDeleteBucket($nameBucket)
    {

        try {
            $this->client->deleteBucket([
                'Bucket' => $nameBucket,
            ]);

            return back();
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }


    public function doDeleteAllObjectsFromBucket($nameBucket)
    {
        try {
            $results = $this->client->listObjects(['Bucket' => $nameBucket])->get('Contents');
            if ($results == !null) {
                foreach ($results as $key => $value) {
                    $this->client->deleteObject([
                        'Bucket' => $nameBucket,
                        'Key'    => $value['Key'],
                    ]);
                }
            } else {
                echo "Files not found";
                die();
            }
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return back();
    }


    /*---------------S3-----------------*/

    public function doUpload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file        = $request->file('file');
        $fileName    = $file->getClientOriginalName();
        $storagePath = storage_path('app/');
        $file->move($storagePath, $fileName);

        $filepath = $storagePath . '/' . $fileName;
        $keyname  = basename($filepath);

        try {
            $result = $this->client->putObject([
                'Bucket'     => $this->bucket,
                'Key'        => $keyname,
                'SourceFile' => $filepath,
                'ACL'        => 'public-read'
            ]);

        } catch (S3Exception $e) {
            return Response()->json(['data' => $e->getMessage()]);
        }
        $file = $fileName;
        Storage::delete($fileName);

        return redirect('s3')->with('status', '<strong>Success!</strong> File successfully uploaded to S3');
    }


//    public function doDelete($filename)
//    {
//        try {
//            $this->client->deleteObject([
//                'Bucket'       => $this->bucket,
//                'Key'          => $filename,
//                'RequestPayer' => 'requester'
//            ]);
//        } catch (S3Exception $e) {
//            return Response()->json(['success' => $e->getMessage()]);
//        }
//
//        return Response()->json(['success' => true]);
//    }


    public function doDelete()
    {
        $filename = $_POST['name'];
        $url = parse_url($filename);
 
        $client = $this->connect();
        $filename = urldecode($filename);
        try {
            $result = $client->deleteObject([
                'Bucket' => $url['host'],
                'Key' => substr($url['path'], 1),
                'RequestPayer' => 'requester'
            ]);
        } catch (S3Exception $e) {
            return  Response()->json(['success' => (array)$e->getMessage()]);
        }
       return Response()->json(['success' => (array)$result]);
    }



    public function doPredictionForm()
    {
        return view('prediction.prediction');
    }


    public function downloadFromS3(Request $request)
    {
        $path = $request->name;
        $path = urldecode($path);
        $this->client->registerStreamWrapper();
        $data     = file_get_contents($path);
        $fileName = basename($path);

        error_reporting(0);
        ob_start();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $fileName);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($data));

        ob_clean();
        ob_end_flush();
        echo $data;
        exit;
    }


    public function fileExists(Request $request)
    {
        $path = $request->name;
        $path = urldecode($path);
        $this->client->registerStreamWrapper();
        if (file_exists($path)) {
            return Response()->json(['data' => true]);
        }
    }
}
