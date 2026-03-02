<?php

class SmsService extends CApplicationComponent
{
	public $apiKey = '';
	public $testMode = true;

	public function send($phone, $text)
	{
		$phone = preg_replace('/[^0-9]/', '', $phone);
		if (strlen($phone) === 10) {
			$phone = '7' . $phone;
		}
		if (strlen($phone) < 11) {
			Yii::log('SmsService: Invalid phone ' . $phone, 'error', 'sms');
			return false;
		}

		$params = array(
			'send' => $text,
			'to' => $phone,
			'apikey' => $this->apiKey ?: 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ',
			'format' => 'json',
			'test' => $this->testMode ? 1 : 0,
		);

		$url = 'https://smspilot.ru/api.php?' . http_build_query($params);
		$response = @file_get_contents($url);

		if ($response === false) {
			Yii::log('SmsService: Request failed', 'error', 'sms');
			return false;
		}

		$data = json_decode($response, true);
		if (isset($data['error'])) {
			$errMsg = $data['error']['description_ru'] ?? $data['error']['description'] ?? json_encode($data);
			Yii::log("SmsService error [{$phone}]: {$errMsg}\nResponse: {$response}", 'error', 'sms');
			return false;
		}

		Yii::log("SMS sent [{$phone}]: {$text}\nAPI response: " . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), 'info', 'sms');
		return $data;
	}

	public function notifyNewBook($author, $book)
	{
		$subs = AuthorSubscription::model()->findAllByAttributes(array('author_id' => $author->id));
		$text = "Новая книга от {$author->name}: {$book->title}";
		if (mb_strlen($text) > 70) {
			$text = mb_substr($text, 0, 67) . '...';
		}
		foreach ($subs as $sub) {
			$this->send($sub->phone, $text);
		}
	}
}
