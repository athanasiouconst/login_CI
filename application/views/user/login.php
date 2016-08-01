
<?php if (!$is_authenticated): ?>

    <?php if ($this->session->userdata('userIsLoggedIn')) { ?>

        <a href="<?php echo base_url('user'); ?>">user's home page</a>
    <?php } else { ?>
        <a href="<?php echo base_url(); ?>">home page</a>    
    <?php } ?>

    <?php if (isset($error)) : ?>
        <?= $error ?>
        <?php echo validation_errors(); ?>                  
    <?php endif; ?>


    <br><br>
    <?php echo form_open('user/verify'); ?>

    <input type="text" id="username" name="username"  placeholder="Username" >
    <input type="password" id="password" name="password"  placeholder="Password">
    <input  type="submit" value="Login!" />

    <?php echo form_close(); ?>
<?php endif; ?> 
