   <style>
       body {
           margin: 0;
       }

       .left-menu {
           width: 250px;
           height: 100vh;
           position: fixed;
           top: 0;
           left: -250px;
           background-color:rgb(222, 103, 24);
           border-right: 1px solid #ddd;
           overflow-y: auto;
           transition: left 0.3s ease;
           padding: 1rem;
       }

       .left-menu.show {
           left: 0;
       }

       .content {
           margin-left: 0;
           transition: margin-left 0.3s ease;
       }

       .content.menu-open {
           margin-left: 250px;
       }
   </style>

   <!-- Hamburger Icon -->
   <button id="hamburgerBtn" class="btn btn-primary m-3">
       <i class="fas fa-bars"></i>
   </button>

   <!-- Left Menu -->
   <div id="leftMenu" class="left-menu">
       <h5>Left Menu</h5>
       <ul class="nav flex-column">
           <li class="nav-item">
               <a class="nav-link active" href="#home">Home</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="#about">About</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="#services">Services</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="#contact">Contact</a>
           </li>
       </ul>
   </div>

   <script>
       const hamburgerBtn = document.getElementById('hamburgerBtn');
       const leftMenu = document.getElementById('leftMenu');
       const mainContent = document.getElementById('mainContent');

       hamburgerBtn.addEventListener('click', () => {
           leftMenu.classList.toggle('show');
           mainContent.classList.toggle('menu-open');
       });
   </script>