# aws-event-bridge-wrapper

Minimalist package to support the `aws events put-events --entries <entries>` command

### Basic usage:

```
$awsEBCli = EventBridge(['entries' => <eventEntriesJsonPath>]);

$result = $awsEBCli->putEvents();
```