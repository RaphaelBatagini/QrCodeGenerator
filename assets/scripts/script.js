(function($){
	function formNavigation() {
		let form = $('form.form-steps');
		var currentStep = 1;
		let $nextButton = $('.next');
        var maxStep = 2;

		// first execution
        $('.step[data-step="1"]').show();

		// action on next step click
		$nextButton.click(function(event) {
			event.preventDefault();

			if (currentStep >= maxStep) {
				return;
			}

			currentStep++;
			goToStep(currentStep);
        });
        
		// submit form
		$('body').on('click', '.finish', function(){
			if (!$(this).valid()) {
				return;
			}

			toggleLoader();
			setTimeout(function() {
				form.submit();
			}, 100);
		});
	}

	function goToStep(step)
	{
		$('.step').hide();
		$('.step[data-step="'+step+'"]').show();
	}

    $(document).ready(function(){
        formNavigation();
    });
})(jQuery);