 <footer class="footer_section shadow">
   <div class="container">
     <div class="copyright">
       <div class="row p-4">
         <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
           &copy; <a class="border-bottom" href="https://wasd.netmedia-framecode.com" target="_blank">WASD Netmedia Framecode</a>, All Right Reserved.
         </div>
         <div class="col-md-6 text-center text-md-end">
           Develop By <a class="border-bottom" href="https://pddikti.kemdikbud.go.id/data_mahasiswa/MjVGNDNEOTQtNzkzMy00QzQ4LTk4QUYtNEU1ODM3RjY2REIy" target="_blank">VINI ALVIAN HUKI</a>
         </div>
       </div>
     </div>
   </div>
 </footer>

 <script src="<?= $baseURL ?>assets/js/jquery-3.4.1.min.js"></script>
 <script src="<?= $baseURL ?>assets/js/bootstrap.js"></script>
 <script src="<?= $baseURL ?>assets/js/custom.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>

 <script>
   const showMessage = (type, title, message) => {
     if (message) {
       Swal.fire({
         icon: type,
         title: title,
         text: message,
       });
     }
   };

   showMessage("success", "Berhasil Terkirim", $(".message-success").data("message-success"));
   showMessage("info", "For your information", $(".message-info").data("message-info"));
   showMessage("warning", "Peringatan!!", $(".message-warning").data("message-warning"));
   showMessage("error", "Kesalahan", $(".message-danger").data("message-danger"));
 </script>