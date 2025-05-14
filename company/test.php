<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Modal Popup Example</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    /* Button styling */
    #openModalBtn {
      padding: 10px 20px;
      background-color: #007bff;
      border: none;
      color: white;
      cursor: pointer;
      border-radius: 5px;
    }

    /* Modal background */
    .modal {
      display: none; /* Hidden by default */
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
    }

    /* Modal content box */
    .modal-content {
      background-color: white;
      margin: 15% auto;
      padding: 20px;
      border-radius: 8px;
      width: 300px;
      text-align: center;
      position: relative;
    }

    /* Close button */
    .close-btn {
      color: #aaa;
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }

    .close-btn:hover {
      color: red;
    }
  </style>
</head>
<body>

  <button id="openModalBtn">Click Me</button>

  <!-- Modal -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>User Modal</h2>
      <p>This is a simple modal popup.</p>
    </div>
  </div>

  <script>
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('myModal');
    const closeBtn = document.querySelector('.close-btn');

    openModalBtn.addEventListener('click', () => {
      modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>

</body>
</html>
