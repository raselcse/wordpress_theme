(function() {
	tinymce.PluginManager.add('my_mce_button', function( editor, url ) {
		editor.addButton( 'my_mce_button', {
			text: 'Pallash Shortcode List',
			icon: false,
			type: 'menubutton',
			menu: [
				{
					text: 'Items',
					menu: [
								 {
							text: 'Column',

							menu: [

								{

									text: 'One_Half',

									onclick: function() {

										editor.insertContent('[one_half]');

									}

								},

								{

									text: 'One_Half Close',

									onclick: function() {

										editor.insertContent('[/one_half]');

									}

								}

							]

						},
						{
							text: 'Skill',
                            onclick: function() {

										editor.insertContent('[skill title="" percentile=""]');

									}
						
						},
						{
							text: 'Counter',
                            onclick: function() {

										editor.insertContent('[counter title="" number=""]');

									}
						
						},
						{
							text: 'Pricing',
                            onclick: function() {

										editor.insertContent('[pricing popular=" " price=" " memory=" " domain=" " website=" "]');

									}
						
						},
                          
						{
							text: 'Team Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Team',
									body: [
										{
											type: 'textbox',
											name: 'name',
											label: 'Name',
											
										},
										{
											type: 'textbox',
											name: 'designation',
											label: 'Designation',
											
											
										},
										{
										type: 'textbox',
										name: 'photourl',
										label: 'Picture url',
										},
										{
										type: 'textbox',
										name: 'skill1',
										label: 'Skill 1',
										},
										{
										type: 'textbox',
										name: 'skill2',
										label: 'Skill 2',
										},
										{
										type: 'textbox',
										name: 'skill3',
										label: 'Skill 3',
										},
										{
										type: 'textbox',
										name: 'social1_icon',
										label: 'First Social icon(add unicode of font awosam)',
										},
										{
										type: 'textbox',
										name: 'social1_link',
										label: 'First Social link',
										},
										
										{
										type: 'textbox',
										name: 'social2_link',
										label: 'Second Social link',
										},
										{
										type: 'textbox',
										name: 'social3_icon',
										label: 'Third Social icon(add unicode of font awosam)',
										},
										{
										type: 'textbox',
										name: 'social3_link',
										label: 'Third Social link',
										}
									
									],
									onsubmit: function( e ) {
										editor.insertContent( '[teams name="' + e.data.name + '" designation="' + e.data.designation + '" photourl="' + e.data.photourl + '" skill1="' + e.data.skill1 + '"skill2="' + e.data.skill2 + '" skill3="' + e.data.skill3 + '" skill4="' + e.data.skill4 + '"social1_icon="' + e.data.social1_icon + '"social1_link="' + e.data.social1_link + '"social2_icon="' + e.data.social2_icon + '"social2_link="' + e.data.social2_link + '"social3_icon="' + e.data.social3_icon + '"social3_link="' + e.data.social3_link + '" ]');
									}
								});
							}
						}
					]
				},
				
				{
					text: 'Column',

					menu: [

						{

							text: 'One_Half',

							onclick: function() {

								editor.insertContent('[one_half] Content Here [/one_half]');

							}

						},

						{

							text: 'One_Third',

							onclick: function() {

								editor.insertContent('[one_third]Content Here [/one_third]');

							}

						},

						{

							text: 'One_Fourth',

							onclick: function() {

								editor.insertContent('[one_fourth] Content Here [/one_fourth]');

							}

						},

						{

							text: 'One_Eight',

							onclick: function() {

								editor.insertContent('[one_eight] Content Here [/one_eight]');

							}

						},
						{

							text: 'full_width',

							onclick: function() {

								editor.insertContent('[full_width] Content Here [/full_width]');

							}

						}

				

					]

				},
				
				{
					text: 'Teams',

					menu: [

						{

							text: 'Team',

							onclick: function() {

								editor.insertContent('[teams name="" designation="" photourl="" skill1="" skill2="" social1_icon=" fontwasum unicode icon" social1_link=""]');

							}

						}

				

					]

				},
				{
					text: 'Title',

					menu: [

						{

							text: 'Inner Title',

							onclick: function() {

								editor.insertContent('[inner_title title=" "]');

							}

						},
						{

							text: 'outer Title',

							onclick: function() {

								editor.insertContent('[title title=" " subtitle=""]');

							}

						}

				

					]

				},
				
				{
					text: 'Services',

					menu: [

						{

							text: 'Services',

							onclick: function() {
								editor.windowManager.open( {
									title: 'Services',
									body: [
										{
											type: 'textbox',
											name: 'title',
											label: 'Title',
											
										},
										{
											type: 'textbox',
											name: 'description',
											label: 'Description',
											
											
										},
										{
										type: 'textbox',
										name: 'icon',
										label: 'Font Awasome Icon',
										},
										
									
									],
									onsubmit: function( e ) {
										editor.insertContent( '[services title="' + e.data.title + '" description="' + e.data.description + '" icon="' + e.data.icon + '" ]');
									}
								});
							}

						}

				

					]

				}
				
			]
		});
	});
})();