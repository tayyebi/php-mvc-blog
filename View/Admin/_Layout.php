<link href="<?php echo _Root ?>static/css/dashboard.css" rel="stylesheet">
<script src="<?php echo _Root ?>static/js/tinymce.js"></script>

<link href="<?php echo _Root ?>static/css/ezdz.css" rel="stylesheet">
<script src="<?php echo _Root ?>static/js/ezdz.js"></script>

<script>
tinymce.init({
    selector: '.tinymce',
    plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table tc help',
    // toolbar: 'fontselect save print template codesample'
    toolbar: 'fullscreen  preview | undo redo | bold italic underline strikethrough | formatselect | ltr rtl | alignleft aligncenter alignright alignjustify | fontsizeselect | numlist bullist checklist | forecolor backcolor casechange removeformat | outdent indent | pagebreak | charmap emoticons | insertfile image media link anchor | a11ycheck | showcomments addcomment',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    toolbar_drawer: 'sliding',
    spellchecker_dialog: true,
});
</script>


<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3><?php echo _AppName ?></h3>
        </div>

        <?php include("Helpers/AdminMenu.php"); ?>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="<?php echo _Root . 'Admin' ?>" class="download">داشبورد ادمین</a>
            </li>
            <li>
                <a href="<?php echo _Root . 'Authentication/Logout' ?>" class="article">خروج از سیستم</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" onclick="ToggleSidebar()" class="btn btn-info">
                    <i class="fas fa-align-right"></i>
                    <span>☰ منو</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo _Root . 'Docs' ?>">مستندات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo _Root . 'Admin/User/' . $_COOKIE['UserId'] ?>">تغییر کلمه‌ی عبور</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<?php
// Message Modal
if (isset($Data['Message'])) {
?>
<div class="modal show" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">پیغامی دارید!</h5>
      </div>
      <div class="modal-body">
      <?php echo $Data['Message'] ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('.modal').modal('show');
    });
</script>
<?php
}
?>

        <div id="dynamic" class="container d-flex flex-column">
            <h1 class="row m-4 text-center p-4 align-self-center"><?php echo $Data['Title']; ?></h1>
            <!--VIEW_CONTENT-->
        </div>
    </div>
</div>

<script type="text/javascript">
    function ToggleSidebar(){
        // Show and hide sidebar
        $('#sidebar').toggleClass('active');
    };
    $(document).ready(function(){
        // Show hints on hover
        $('[data-toggle="tooltip"]').tooltip();
        // Alow drag 'n drop
        $('[type="file"].ezdz').ezdz(); 
        // Standard tables
        $('table').DataTable();
        // Beautify inputs
        $('input, select').addClass("form-control");
    });
</script>