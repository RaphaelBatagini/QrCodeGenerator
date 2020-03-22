(function($){
	$(document).ready(function(){
		function formNavigation() {
			let form = $('form.form-steps');
			var currentStep = 1;
			let $nextButton = $('.next');
			var maxStep = 2;

			// first execution
			$('.step[data-step="1"]').show();

			// action on next step click
			$nextButton.click(function() {
				if (!validateForm($(this))) {
					return;
				}
			
				if (currentStep >= maxStep) {
					return;
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
		
		formNavigation();
		
		jQuery('.phone').inputmask("(99)99999-9999");
		jQuery('.date').inputmask("99/99/9999");
    });
})(jQuery);