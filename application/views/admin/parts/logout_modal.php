<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Weet u het zeker?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Klik hieronder op "Uitloggen" als u klaar bent om uw huidige sessie te beëindigen.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
				<a class="btn btn-primary" href="<?= site_url('auth/logout'); ?>">Uitloggen</a>
			</div>
		</div>
	</div>
</div>