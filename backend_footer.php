

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="signout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="backend/vendor/jquery/jquery.min.js"></script>
  <script src="backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="backend/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="backend/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="backend/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="backend/js/demo/datatables-demo.js"></script>

  <!-- summernote js -->
  <script type="text/javascript" src="summernote/summernote-bs4.min.js"></script>

  <!-- flip js -->
  <script src="backend/js/jquery.flip.min.js"></script>

  <script type="text/javascript">
    
    function readURL(input) 
    {
      if (input.files && input.files[0]) 
      {
        var reader = new FileReader();
          
        reader.onload = function (e) 
        {
          $('.previewImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $(".newImage").change(function()
    {
        readURL(this);
    });

    $('.summernote').summernote({
        placeholder: 'Description',
        tabsize: 2,
        height: 100
    });

  </script>

</body>

</html>
