<template>
	<div>
		<h1>{{ title }}</h1>
		<div class="row">
			<div class="col-md-3 offset-md-9">
				<form @submit.prevent="postRfid">
					<input type="text" name="rfid_no" class="form-control" v-model="rfid_no">
				</form>
			</div>
		</div>
		<div style="margin-top: 20px;"></div>
		<div class="row">
			<div class="col-6">
				<b-card>
					<img v-bind:src="personImg" style="width: 100%;">
					<div class="card-text">
						<h3>{{ personFirstname }}</h3>
					</div>
				</b-card>
			</div>
			<div class="col-6">
				<b-card>
					<div class="row">
						<div class="col-md-3">
							<img v-bind:src="prevPersonImg" width="100%">
						</div>
						<div class="col-md-9">
							<div class="card-text">
								<h3>{{ personFirstname }}</h3>
							</div>
						</div>
					</div>
				</b-card>
				<div style="margin-top: 20px;"></div>
				<b-card>
					<div class="row">
						<div class="col-md-3">
							<img v-bind:src="prevPersonImg" width="100%">
						</div>
						<div class="col-md-9">
							<div class="card-text">
								<h3>{{ personFirstname }}</h3>
							</div>
						</div>
					</div>
				</b-card>
			</div>
		</div>

	</div>
</template>

<script>
	export default {
		props: ['title'], // in jquery, its more like 'use' function
		data() {
			return {
				firstImage: '',
				rfid_no: '',
				personFirstname: '',
				personImg: '',
				prevPersonFirstname: '',
				prevPersonImg: '',
				prevPersonRfidNo: '',
				// currentCont: false,
				// prevCont: false
			}
		},

		// created() {
		// 	this.getPerson();
		// },

		methods: {
			postRfid() {
				axios({
					method: 'post',
					url: 'api/rfid/postTimeOut',
					data: {
						rfidNo: this.rfid_no
					}
				})
					.then(function(response) {
						
					})
					.then(data => {
						this.getPerson();
						this.getPrevPerson();
						this.getThirdPerson();
						this.rfid_no = '';
						// this.currentCont = true;
						// this.prevCont = true;
					});
			},

			getPerson() {
				axios.get('api/rfid/getPerson', {
					params: {
						rfidNo: this.rfid_no
					}
				})
					.then(function(response) {
						this.$set(this, 'personFirstname', response.data.firstname)
						this.$set(this, 'personImg', response.data.img)
					}.bind(this));
			},

			getPrevPerson() {
				axios.get('api/rfid/getPrevPerson', {
					params: {
						rfidNo: this.rfid_no
					}
				})
					.then(function(response) {
						this.$set(this, 'prevPersonFirstname', response.data.firstname)
						this.$set(this, 'prevPersonImg', response.data.img)
						this.$set(this, 'prevPersonRfidNo', response.data.rfid_no)
					}.bind(this));
			},

			getThirdPerson() {
				axios.get('api/rfid/getThirdPerson', {
					params: {
						rfidNo: this.rfid_no
					}
				})
					.then(function(response) {
						this.$set(this, 'prevPersonFirstname', response.data.firstname)
						this.$set(this, 'prevPersonImg', response.data.img)
					}.bind(this));
			}
		}
	}
</script>
