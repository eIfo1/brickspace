<?php
class rest
{

  function response(string $status, array $data = [])
  {
    header("Content-type: application/json");
    $status = ["status" => $status];
    $response = (!empty($data)) ? array_merge($status, $data) : $status;
    echo json_encode($response);
  }

  function error(string $message = "")
  {
    $message = (!empty($message)) ? ["error" => $message] : [];
    header("Content-type: application/json");
    $this->response("error", $message);
  }

  function success(array $data = [])
  {
    header("Content-type: application/json");
    $this->response("ok", $data);
  }
}

$rest = new rest;
