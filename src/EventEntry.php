<?php
/**
 * Created by Synida Pry.
 * Copyright © 2022. All rights reserved.
 */

namespace synida\AwsEventBridgeWrapper;

/**
 * Class EventEntry
 * @package common\components\aws
 *
 * @property string $Detail
 * @property string $DetailType
 * @property string $EventBusName
 * @property string[] $Resources
 * @property string $Source
 * @property integer $Time
 * @property string $TraceHeader
 */
#[AllowDynamicProperties]
class EventEntry
{
    public string $Detail;
    public string $DetailType;
    public string $EventBusName;
    public array $Resources;
    public string $Source;
    public int $Time;
    public string $TraceHeader;

    /**
     * EventEntry constructor.
     *
     * @param array $entry
     * @author Synida Pry
     */
    public function __construct(array $entry)
    {
        $allowedFields = [
            'Detail',
            'DetailType',
            'EventBusName',
            'Resources',
            'Source',
            'Time',
            'TraceHeader'
        ];

        foreach ($entry as $field => $value) {
            if (!in_array($field, $allowedFields, true)) {
                continue;
            }

            $this->{$field} = $value;
        }
    }
}
