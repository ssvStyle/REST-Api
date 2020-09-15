<?php

class DataValidTest extends PHPUnit\Framework\TestCase
{
    public function testIsNameEmpty()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => '',
        ]);
        $this->assertFalse($dataValid->fieldName());
    }
    public function testIsNameNoVar()
    {
        $dataValid = new \App\Models\DataValidation(['name']);
        $this->assertFalse($dataValid->fieldName());
    }
    public function testIsNameNotInt()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => '324hgkjh',
        ]);
        $this->assertTrue($dataValid->fieldName());
    }
    public function testIsNameNotSpaseStart()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => '   asdf',
        ]);
        $this->assertTrue($dataValid->fieldName());
    }
    public function testIsEmptyData()
    {
        $dataValid = new \App\Models\DataValidation([]);
        $this->assertFalse($dataValid->fieldName());
    }
    public function testValidName()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
        ]);
        $this->assertTrue($dataValid->fieldName());
    }

    public function testEmailValid()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'ssv.style@gmail.com'
        ]);
        $this->assertTrue($dataValid->fieldEmail());
    }
    public function testValidEmailEmpty()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => ''
        ]);
        $this->assertFalse($dataValid->fieldEmail());
    }
    public function testValidEmailText()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf'
        ]);
        $this->assertFalse($dataValid->fieldEmail());
    }
    public function testValidTaskIsEmpty()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => ''
        ]);
        $this->assertFalse($dataValid->fieldTask());
    }

    public function testValidTaskIsNotExist()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf'
        ]);
        $this->assertFalse($dataValid->fieldTask());
    }
    public function testValidTaskIsTooShort()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'jhgkjhg kjhlkh'
        ]);
        $this->assertFalse($dataValid->fieldTask());
    }
    public function testValidTaskIsTooShortRu()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'ывпываы ываы'
        ]);
        $this->assertFalse($dataValid->fieldTask());
    }
    public function testValidTaskVsSpaces()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => '                                           ываы ываы'
        ]);
        $this->assertFalse($dataValid->fieldTask());
    }
    public function testValidTask()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'jhgkjhg kjhlkh sdfsdfjhb k adsfa 897 fsa d87dsa fas'
        ]);
        $this->assertTrue($dataValid->fieldTask());
    }
    public function testValidTaskRu()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => '       вапор ылвцыувдла оыувда увыа  доавыф 4435 4 '
        ]);
        $this->assertTrue($dataValid->fieldTask());
    }
    public function testValidStatusIdIsset()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'jhgkjhg kjhlkh sdfsdfjhb k adsfa 897 fsa d87dsa fas'
        ]);
        $this->assertFalse($dataValid->fieldStatusId());
    }
    public function testValidStatusIdIsEmpty()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'jhgkjhg kjhlkh sdfsdfjhb k adsfa 897 fsa d87dsa fas',
            'status' => ''
        ]);
        $this->assertFalse($dataValid->fieldStatusId());
    }
    public function testValidStatusIdIsNull()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'jhgkjhg kjhlkh sdfsdfjhb k adsfa 897 fsa d87dsa fas',
            'status' => '0'
        ]);
        $this->assertFalse($dataValid->fieldStatusId());
    }
    public function testValidStatusIdIsMinusNum()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'jhgkjhg kjhlkh sdfsdfjhb k adsfa 897 fsa d87dsa fas',
            'status' => '-324'
        ]);
        $this->assertFalse($dataValid->fieldStatusId());
    }
    public function testValidStatusId()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'jhgkjhg kjhlkh sdfsdfjhb k adsfa 897 fsa d87dsa fas',
            'status' => '7767'
        ]);
        $this->assertTrue($dataValid->fieldStatusId());
    }
    public function testGetValidTask()
    {
        $dataValid = new \App\Models\DataValidation([
            'name' => 'ssv',
            'email' => 'xcbvdxf@sdf',
            'job' => 'jhgkjhg kjhlkh sdfsdfjhb k adsfa 897 fsa d87dsa fas',
            'status' => '7767'
        ]);
        $dataValid->fieldName();
        $dataValid->fieldEmail();
        $dataValid->fieldTask();
        $dataValid->fieldStatusId();
        $arr = $dataValid->getValidData();

        $this->assertArrayHasKey('name', $arr);
        $this->assertArrayHasKey('email', $arr);
        $this->assertArrayHasKey('job', $arr);
        $this->assertArrayHasKey('status', $arr);

    }
}