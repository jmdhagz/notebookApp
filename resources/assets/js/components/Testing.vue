<template>
	<div>
		<div class="jumbotron">
			<!-- <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Starting Zip</label>
						<input type="text" class="form-control" v-model="startingZip">
						<span><i>{{ startingCity }}</i></span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Starting Zip</label>
						<input type="text" class="form-control" v-model="endingZip">
						<span><i> {{ endingCity }} </i></span>
					</div>
				</div>
			</div> -->
			<div class="row outer-block">
				<div class="col-md-3 items">
					<div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
				<div class="col-md-3 items">
					<div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
				<div class="col-md-3 items">
					<div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
				<div class="col-md-3 items">
					<div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
				<div class="col-md-3 items">
					<div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
				<div class="col-md-3 items">
					<div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
				<div class="col-md-3 items">
					<div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				message: 'Journey',
				taskList: [
					{ id: 1, description: 'Luto Sud.an', completed: false },
					{ id: 2, description: 'Luto rice', completed: false },
					{ id: 3, description: 'Ligo', completed: false },
					{ id: 4, description: 'Mukaon breakfast', completed: true },
					{ id: 5, description: 'Libang', completed: false },
				],
				startingZip: '',
				startingCity: '',
				endingZip: '',
				endingCity: ''
			}
		},

		watch: {
			startingZip: _.debounce(function() {
				this.startingCity = ''
				if (this.startingZip.length == 5) {
					this.lookupStartingCity()
				}
			}, 500)
		},

		methods: {
			lookupStartingCity() {
				var app = this
				this.startingCity = 'Searching...'
				fetch('http://ziptasticapi.com/' + this.startingZip)
					.then(response => response.json()) // convert the responsed data into json
					.then(response => {
						if (response.error) {
							this.startingCity = response.error
						}
					})
			}
		}
	}
</script>

<style type="text/css">
	.outer-block { 
    -moz-column-gap: 1em !important;
    -webkit-column-gap: 1em !important;
    column-gap: 1em !important;
}
.items { 
    display: inline-block !important;
    margin: 0 0 1em !important;
    border: 1px solid black !important;
}
</style>