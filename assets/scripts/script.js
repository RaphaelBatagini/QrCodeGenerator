(function($){
	$(document).ready(function(){
		function formNavigation() {
			var currentStep = 1;
			let $nextButton = $('.next');
			var maxStep = 3;

			// first execution
			$('.step[data-step="1"]').show();

			// action on next step click
			$nextButton.click(async function() {
				if (!validateForm($(this))) {
					return;
				}
			
				if (currentStep >= maxStep) {
					return;
				}
				
				if (currentStep == 2) {
					var emailRegistered = await userAlreadyRegistered($('#email').val());
					if (emailRegistered[0] && emailRegistered[0].ID) {
						$('.modal').modal('show');
						return;
					}
				}

				currentStep++;
				goToStep(currentStep);
			});
			
			// submit form
			$('body').on('click', '.finish', function(event){
				if (!validateForm($(this))) {
					return;
				}
				
				$(this).closest('form').submit();
			});
		}

		function goToStep(step)
		{
			$('.step').hide();
			$('.step[data-step="'+step+'"]').show();
		}

		function validateForm($this)
		{
			var form = $this.closest('form');
			form.validate();

			if (!form.valid()) {
				form.validate().element(form.find('input:visible,select:visible'));
				return false;
			}

			return true;
		}

		async function userAlreadyRegistered(email)
		{
			return jQuery.ajax({
				url: '/wp-admin/admin-ajax.php',
				type: 'POST',
				data: {
					'action': 'check_email',
					'email': email,
				},
				dataType: 'JSON'
			});
		}
		
		formNavigation();
		
		jQuery('.phone').inputmask("(99)99999-9999");
		jQuery('.date').inputmask("99/99/9999");
    });
})(jQuery);