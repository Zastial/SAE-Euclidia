<script src="../js/notiflix-aio-3.2.5.min.js"></script>
<?php if($this->session->flashdata('success')){ ?>
    <script>Notiflix.Notify.success('<?php echo $this->session->flashdata('success'); ?>', {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});</script>
<?php }else if($this->session->flashdata('error')){  ?>
    <script>Notiflix.Notify.failure('<?php echo $this->session->flashdata('error'); ?>', {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});</script>
<?php }else if($this->session->flashdata('warning')){  ?>
    <script>Notiflix.Notify.warning('<?php echo $this->session->flashdata('warning'); ?>', {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});</script>
<?php }else if($this->session->flashdata('info')){  ?>
    <script>Notiflix.Notify.info('<?php echo $this->session->flashdata('info'); ?>', {timeout:5000, distance:'90px', width:"400px", fontSize:"16px"});</script>
<?php } ?>
