<?php

// This file is auto-generated, don't edit it. Thanks.

namespace AlibabaCloud\SDK\ICE\V20201109\Models;

use AlibabaCloud\Tea\Model;

class SubmitMediaProducingJobRequest extends Model
{
    /**
     * @var string
     */
    public $clientToken;

    /**
     * @var string
     */
    public $clipsParam;

    /**
     * @var string
     */
    public $editingProduceConfig;

    /**
     * @var string
     */
    public $outputMediaConfig;

    /**
     * @var string
     */
    public $outputMediaTarget;

    /**
     * @var string
     */
    public $projectId;

    /**
     * @var string
     */
    public $projectMetadata;

    /**
     * @var string
     */
    public $regionId;

    /**
     * @var string
     */
    public $source;

    /**
     * @var string
     */
    public $templateId;

    /**
     * @var string
     */
    public $timeline;

    /**
     * @var string
     */
    public $userData;
    protected $_name = [
        'clientToken'          => 'ClientToken',
        'clipsParam'           => 'ClipsParam',
        'editingProduceConfig' => 'EditingProduceConfig',
        'outputMediaConfig'    => 'OutputMediaConfig',
        'outputMediaTarget'    => 'OutputMediaTarget',
        'projectId'            => 'ProjectId',
        'projectMetadata'      => 'ProjectMetadata',
        'regionId'             => 'RegionId',
        'source'               => 'Source',
        'templateId'           => 'TemplateId',
        'timeline'             => 'Timeline',
        'userData'             => 'UserData',
    ];

    public function validate()
    {
    }

    public function toMap()
    {
        $res = [];
        if (null !== $this->clientToken) {
            $res['ClientToken'] = $this->clientToken;
        }
        if (null !== $this->clipsParam) {
            $res['ClipsParam'] = $this->clipsParam;
        }
        if (null !== $this->editingProduceConfig) {
            $res['EditingProduceConfig'] = $this->editingProduceConfig;
        }
        if (null !== $this->outputMediaConfig) {
            $res['OutputMediaConfig'] = $this->outputMediaConfig;
        }
        if (null !== $this->outputMediaTarget) {
            $res['OutputMediaTarget'] = $this->outputMediaTarget;
        }
        if (null !== $this->projectId) {
            $res['ProjectId'] = $this->projectId;
        }
        if (null !== $this->projectMetadata) {
            $res['ProjectMetadata'] = $this->projectMetadata;
        }
        if (null !== $this->regionId) {
            $res['RegionId'] = $this->regionId;
        }
        if (null !== $this->source) {
            $res['Source'] = $this->source;
        }
        if (null !== $this->templateId) {
            $res['TemplateId'] = $this->templateId;
        }
        if (null !== $this->timeline) {
            $res['Timeline'] = $this->timeline;
        }
        if (null !== $this->userData) {
            $res['UserData'] = $this->userData;
        }

        return $res;
    }

    /**
     * @param array $map
     *
     * @return SubmitMediaProducingJobRequest
     */
    public static function fromMap($map = [])
    {
        $model = new self();
        if (isset($map['ClientToken'])) {
            $model->clientToken = $map['ClientToken'];
        }
        if (isset($map['ClipsParam'])) {
            $model->clipsParam = $map['ClipsParam'];
        }
        if (isset($map['EditingProduceConfig'])) {
            $model->editingProduceConfig = $map['EditingProduceConfig'];
        }
        if (isset($map['OutputMediaConfig'])) {
            $model->outputMediaConfig = $map['OutputMediaConfig'];
        }
        if (isset($map['OutputMediaTarget'])) {
            $model->outputMediaTarget = $map['OutputMediaTarget'];
        }
        if (isset($map['ProjectId'])) {
            $model->projectId = $map['ProjectId'];
        }
        if (isset($map['ProjectMetadata'])) {
            $model->projectMetadata = $map['ProjectMetadata'];
        }
        if (isset($map['RegionId'])) {
            $model->regionId = $map['RegionId'];
        }
        if (isset($map['Source'])) {
            $model->source = $map['Source'];
        }
        if (isset($map['TemplateId'])) {
            $model->templateId = $map['TemplateId'];
        }
        if (isset($map['Timeline'])) {
            $model->timeline = $map['Timeline'];
        }
        if (isset($map['UserData'])) {
            $model->userData = $map['UserData'];
        }

        return $model;
    }
}
