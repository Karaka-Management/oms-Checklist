# Specification

```json
{
	"elements": [
		{
			"create_task": 1,
			"type": 1,
			"optional": 0,
			"description": "",
			"text": "",
			"labels": [],
			"values": []
		}
	]
}
```

e.g.

Task description	-	Labels/values	-	who?	-	until_when	-	when_actually	-	reference (e.g. task)

Should have a checklist status, usually set/checked with every change. But can also be manually set, e.g. if you want to cancel a checklist/close it without finishing it.


SURVEY!!!!!

```json
{
	"elements": [
		{
			"type": 1,
			"optional": 0,
			"description": "",
			"text": "",
			"labels": [],
			"values": []
		}
	]
}
```

## Type

* 1 = Headline
* 2 = Checkbox
* 3 = Radio
* 4 = Textfield
* 5 = Dropdown

## Text

Headline/question, ...

## Labels

In case this element has different labels