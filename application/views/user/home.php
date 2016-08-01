<?php if ($this->session->userdata('userIsLoggedIn')) { ?>

    <a href="<?php echo base_url('user'); ?>">user's home page</a>
<?php } ?>

This is the user's home page


<strong>welcome ,</strong> <?= $username ?>
<a href="<?php echo base_url('user/logout'); ?>" >Logout</a>
<br><?php echo $this->session->flashdata('success_msg'); ?><br>



