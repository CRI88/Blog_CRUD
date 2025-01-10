<?php
session_start();
$idUser = $_SESSION['idUser']; // ID del usuario logueado
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <script>
        // Define la variable senderId como global desde PHP
        window.senderId = <?php echo json_encode($idUser); ?>;
    </script>
    <script defer src="chat.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex flex-col">

    <div class="flex flex-col">
        <label for="recipient" class="font-bold">Seleccionar Usuario:</label>
        <select id="recipient" class="border rounded p-2">
            <!-- Aquí se cargarán los usuarios dinámicamente -->
        </select>
    </div>

    <!-- Botón de Cerrar Sesión -->
    <div class="flex justify-end p-4">
        <form action="../server/logout.php" method="POST">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Cerrar Sesión
            </button>
        </form>
    </div>

    <!-- Chat Container -->
    <div class="container mx-auto my-auto flex flex-col h-full bg-white rounded-lg shadow-lg p-6">
        <div id="chat-box" class="flex-grow overflow-y-auto p-4 border border-gray-200 rounded-lg bg-gray-50">
            <!-- Los mensajes aparecerán aquí -->
        </div>

        <!-- Message Input -->
        <div class="mt-4 flex">
            <input id="message-input" type="text" placeholder="Escribe un mensaje..."
                class="flex-grow border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button id="send-btn" class="ml-2 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                Enviar
            </button>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');
        const recipientSelect = document.getElementById('recipient');

        let recipientId = null; // El destinatario aún no está seleccionado

        async function fetchUsers() {
            const response = await fetch(`../server/fetch_users.php?idUser=${window.senderId}`);
            const users = await response.json();

            recipientSelect.innerHTML = '<option value="">Seleccionar Usuario</option>';
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.idUser;
                option.textContent = user.userName;
                recipientSelect.appendChild(option);
            });
        }

        async function fetchMessages() {
            if (!recipientId) return;

            const response = await fetch(`../server/fetch_messages.php?recipient_id=${recipientId}`);
            const messages = await response.json();
            chatBox.innerHTML = '';

            console.log('Mensajes recibidos:', messages);

            messages.forEach(message => {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('p-2', 'rounded-lg', 'mb-2', 'max-w-md');
                messageDiv.style.wordBreak = 'break-word';

                if (message.sender_id === window.senderId) {
                    messageDiv.classList.add('ml-auto', 'bg-blue-500', 'text-white');
                } else {
                    messageDiv.classList.add('bg-gray-200', 'text-black');
                }

                messageDiv.innerHTML = `<strong>${message.sender_name}</strong>: ${message.message}`;
                chatBox.appendChild(messageDiv);
            });

            chatBox.scrollTop = chatBox.scrollHeight;
        }

        async function sendMessage() {
            const message = messageInput.value.trim();
            if (!message || !recipientId) return;

            await fetch('../server/send_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ sender_id: window.senderId, recipient_id: recipientId, message })
            }).then(response => response.json())
              .then(data => console.log('Respuesta del servidor:', data))
              .catch(error => console.error('Error al enviar el mensaje:', error));

            messageInput.value = '';
            fetchMessages();
        }

        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', e => {
            if (e.key === 'Enter') sendMessage();
        });

        recipientSelect.addEventListener('change', () => {
            recipientId = recipientSelect.value;
            console.log('Destinatario seleccionado:', recipientId);
            fetchMessages();
        });

        setInterval(fetchMessages, 2000);

        fetchUsers();
    </script>
</body>

</html>
