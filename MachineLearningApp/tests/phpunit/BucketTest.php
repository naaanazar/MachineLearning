<?php

namespace MachineLearning;

use PHPUnit_Framework_TestCase;
use App\Http\Controllers\BucketController;
use App\Http\Requests\Request;
use App\Tests\RequestBucketExt;

class BucketTest extends PHPUnit_Framework_TestCase
{
    protected $fixture;
    protected $fixture1;
    public function setUp()
    {
        parent::setUp();
        $this->fixture = new BucketController();
        $this->fixture1 = new RequestBucketExt();
        

        require_once __DIR__.'/../../bootstrap/app.php';
    }
    protected function tearDown()
    {
        $this->fixture = NULL;
    }
    public function testCreateBucket()
    {
        $this->fixture1->nameBucket = 'ml-test-buck';
        $createBuck = $this->fixture->createBucket($this->fixture1);
       
       
       
       //для приватних методів не проходить!
//        $conn = $this->fixture->connect();
//        $className = get_class($conn);
//        $this->assertInstanceOf(S3Client::class, $className);
    }
}
