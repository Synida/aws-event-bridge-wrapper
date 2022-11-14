# aws-event-bridge-wrapper

Minimalist package to support the `aws events put-events --entries <entries>` command

### Basic usage:

```
$awsEBCli = new EventBridge(['entries' => <eventEntriesJson>]);

$result = $awsEBCli->putEvents();
```