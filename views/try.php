<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Template</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .chat-container {
      max-width: 600px;
      margin: auto;
      margin-top: 50px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      overflow: hidden;
    }

    .chat-box {
      height: 400px;
      overflow-y: scroll;
      padding: 15px;
      background-color: #ffffff;
    }

    .message {
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      word-wrap: break-word;
      max-width: 80%;
    }

    .message.sent {
      background-color: #007bff;
      color: #fff;
      text-align: right;
      float: right; /* Tambahkan properti float:right */
    }

    .message.received {
      background-color: #e9ecef;
      color: #495057;
      text-align: left;
      float: left; /* Tambahkan properti float:left */
    }

    .input-box {
      padding: 15px;
      background-color: #f1f3f5;
      border-top: 1px solid #ced4da;
    }

    .input-group-text {
      cursor: pointer;
    }
  </style>
</head>

<body>

  <div class="container chat-container">
    <div class="chat-box" id="chatBox">
      <!-- Messages will be displayed here -->
    </div>
    <div class="input-box">
      <div class="input-group">
        <input type="text" class="form-control" id="messageInput" placeholder="Type your message...">
        <div class="input-group-append">
          <span class="input-group-text" onclick="sendMessage()">Send</span>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function sendMessage() {
      var messageInput = document.getElementById('messageInput');
      var chatBox = document.getElementById('chatBox');

      if (messageInput.value.trim() !== '') {
        var message = document.createElement('div');
        message.className = 'message sent';
        message.innerHTML = messageInput.value;

        chatBox.appendChild(message);
        messageInput.value = '';
        chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
      }
    }
  </script>
</body>

</html>
