<?php require APPROOT . '/views/inc/header.php'; ?>
			<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
			<div class="card card-body bg-light mt-5">
				<h2>Add post</h2>
				<p>Crate a post with this form</p>
				<form action="<?php echo URLROOT; ?>/posts/add" method="post">
					<div class="form-group">
						<label for="title">Title<sup>*</sup></label>
						<input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>"><!-- not empty means is name_err-->
							<span class="invalid-feedback"><?php echo $data['title_err']; ?></span><!-- we want display error and don't keep box red-->
					</div>

					<div class="form-group">
						<label for="body">Body: <sup>*</sup></label>
						<textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body'] ; ?></textarea><!-- not empty means is name_err-->
							<span class="invalid-feedback"><?php echo $data['body_err']; ?></span><!-- we want display error and don't keep box red-->
					</div>	
					<input type="submit" class="btn btn-success" value="Sumbit">					
				</form>
			</div>
		
<?php require APPROOT . '/views/inc/footer.php'; ?>