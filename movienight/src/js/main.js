	require('base.js');

	$.ajax({
		url: 'current.json'
	})
	.done(function(data) {




		/*	The Magic
		--------------------------------------------------------------------- */
			var current = data[0]; // current participant

			_.each(participants, function (value) {

				var module = _.template('<div class="item {{hidden}}"><button class="fa fa-check-square" data-name="{{name}}"></button><span>{{name}}</span></div>');
				$('body').append(module({
						name: value,
						hidden: value == current ? '' : '-hidden'
					}));

			});

			$('button').on('click', updateCurrent);

			function updateCurrent() {
				var old_value = current,
					current_index = _.indexOf(participants, current),
					next_index = (current_index == (participants.length - 1)) ? 0 : (current_index + 1);

				$.ajax({
					type: "POST",
					url: 'update_current.php',
					data: {"name": participants[next_index]}
				})
				.done(function(data) {
					current = participants[next_index]; // upadte the current participant
					console.log("Update Successful! :", data);

					$('[data-name="' + old_value + '"]').closest('.item')
						.fadeOut('fast', function () {
							$('[data-name="' + current + '"]').closest('.item').fadeIn('fast');
						});
				})
				.fail(function(error) {
					console.log("Update Failure! :", error);
				});
			}





	})
	.fail(function(error) {
		console.log("error :",error);
	});
