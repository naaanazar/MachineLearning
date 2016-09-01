<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Collection;
>>>>>>> master
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3Controller extends Controller
{
    public $bucket = 'ml-datasets-test';
<<<<<<< HEAD
    public $newBucketName = 'ml-datasets-testing';
=======
>>>>>>> master

    public function predictionForm()
    {
        return view('prediction.prediction');
    }

    private function connect()
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
            ]
        ]);

        return $s3;
    }

<<<<<<< HEAD
    public function uploadFileToS3(Request $request)
=======
    public function upload(Request $request)
>>>>>>> master
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
<<<<<<< HEAD
        $storagePath = storage_path('/app/uploads');
=======
        $storagePath = storage_path('app/uploads');
>>>>>>> master
        $file->move($storagePath, $fileName);

        $filepath = $storagePath . '/' . $fileName;
        $keyname = basename($filepath);
        $client = $this->connect();

        try {
            $result = $client->putObject(array(
                'Bucket' => $this->bucket,
                'Key' => $keyname,
                'SourceFile' => $filepath,
                'ACL' => 'public-read'
            ));

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
<<<<<<< HEAD
        return redirect('list')->with('status', '<strong>Success!</strong> File successfully uploaded to S3');
    }

    public function deleteFileFromS3($filename)
=======
        return redirect('s3/list')->with('status', '<strong>Success!</strong> File successfully uploaded to S3');
    }

    public function delete($filename)
>>>>>>> master
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

<<<<<<< HEAD
    public function listFileFromS3()
    {
        $client = $this->connectToS3();
=======
    public function listS3()
    {
        $client = $this->connect();
>>>>>>> master

        try {
            $result = $client->listObjects([
                'Bucket' => $this->bucket,
                'Delimiter' => '|'
            ]);

<<<<<<< HEAD
<<<<<<< Updated upstream
            $results = $result['Contents'];
=======
=======
>>>>>>> master
            $searchResults = $result['Contents'];
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $collection = new Collection($searchResults);
            $perPage = 5;
<<<<<<< HEAD
            $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
            $paginatedSearchResults->setPath('/s3/list/');
>>>>>>> Stashed changes

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return view('s3.list', compact('results'));

    }

<<<<<<< Updated upstream
    public function listOfBuckets()
    {
        $client = $this->connectToS3();

        try {
            $result = $client->listBuckets([
            ]);

            dd($result);
            //$results = $result['Contents'];
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        //return view('s3.list', compact('results'));
    }


    public function createBucket()
    {
        $client = $this->connectToS3();

        try {

            $client->createBucket([
                'ACL' => 'private',
                'Bucket' => $this->newBucketName . 11, // REQUIRED
                'CreateBucketConfiguration' => [
                    'LocationConstraint' => 'us-east-1',
                ],
//                'GrantFullControl' => '1',
//                'GrantRead' => 'Allow',
//                'GrantReadACP' => 'Allow',
//                'GrantWrite' => 'Allow',
//                'GrantWriteACP' => 'Allow',
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        //return back();

    }


    public function deleteBucket($nameBucket)
    {
        $client = $this->connectToS3();

        try {
//dd($nameBacket);
            $client->deleteBucket([
                'Bucket' => $nameBucket, // REQUIRED
            ]);
=======
            $currentPageSearchResults = $collection->slice(($currentPage - 1)  * $perPage, $perPage)->all();
            $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
            $paginatedSearchResults->setPath('/s3/list/');
>>>>>>> master

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }


    public function deleteAllObjectsFromBucket()
    {
        $client = $this->connectToS3();



        try {

            $results = $client->listObjects(array('Bucket' => $this->newBucketName . 11))->get('Contents');

<<<<<<< HEAD
            foreach($results as $key => $value) {

                $client->deleteObject(array(
                    'Bucket' => $this->newBucketName . 11,
                    'Key' => $value['Key'],
                ));
            }
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }



=======
        return view('s3.list', ['results' => $paginatedSearchResults]);
>>>>>>> master
    }


=======
>>>>>>> Stashed changes


}
