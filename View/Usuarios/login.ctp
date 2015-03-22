<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php
	if ($bloqueado) {
		echo "<p class=\"message\">Para, respira hondo, tómate unos minutos de reflexión y avisa a Pepe o espera un tiempo. Se te ha bloqueado por exeso de contraseñas incorrectas ^_^.</p>\n";
	}
	else {
		echo $this->Form->create('Usuario');
?>
    <fieldset>
        <legend>Accesso restringido a personas autorizadas. Por favor, indica tu usuario y contraseña.</legend>
        <?php echo $this->Form->input('username'); ?>
		<?php echo $this->Form->input('password'); ?>
    </fieldset>
<?php
		echo $this->Form->end(__('Login'));
	}
?>
</div>
