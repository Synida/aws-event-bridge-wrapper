# aws-event-bridge-wrapper

Minimalist package to support the `aws events put-events --entries <entries>` command

### Basic usage:

accepted fields:
https://docs.aws.amazon.com/eventbridge/latest/APIReference/API_PutEvents.html#eventbridge-PutEvents-request-Entries

```
// You put whatever details you want to pass in this array
$detailArray = [
    'task_id' => (new RandomGenerator())->uuid(),
    'revisions' => [
        'id' => 'edit',
        's3_path'=> "s3://{$bucket}/{$s3Key}"
    ]
];

$entryObject = new EventEntry([
    'Source' => 'some.source',
    'DetailType' => 'some.detail.type',
    'Detail' => json_encode($detailArray, JSON_THROW_ON_ERROR)
    // ect..
]);

$entriesJson = json_encode([$entryObject], JSON_THROW_ON_ERROR)

$defaultPath = 'someFilePath';
$filePath = "{$defaultPath}/someFilename.json";

file_put_contents($filePath, $entriesJson);

$awsEBCli = new EventBridge(['entries' => "file://$filePath"]);

$result = $awsEBCli->putEvents();
```