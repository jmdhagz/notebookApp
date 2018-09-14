<template>
	<div>
		<div style="margin-top: 50px;">
			<div class="col-md-12">
				<h1 style="font-family: Nexa;"><b>BIN</b> <button v-if="bin_note_list.length != 0" type="button" class="btn btn-sm btn-outline-danger" @click="emptyBin()">Empty Bin</button></h1>
				<br>
				<div class="row">
					<template v-if="bin_note_list.length != 0">
						<template v-for="bin_note in bin_note_list">
							<template v-if="bin_note.note_type_id == 1">
								<div class="col-md-3">
									<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;" :style="{ 'background-color': bin_note.color_code }">
										<h5 style="font-family: Nexa;"><b>{{ bin_note.note_name | truncate(25) }}</b></h5>
								        <p class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
								            {{ bin_note.note_desc }}
								        </p>
								        <br>
								        <div>
								        	<p style="margin-bottom: 0px; text-align: center; font-size: 14px;" :style=" { 'background-color': bin_note.nb_label_color } ">{{ bin_note.nb_name }}</p>
								        </div>
								        <div style="text-align: left; margin-top: 5px;">
							        		<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
								        		<img :src="restoreImg" v-b-tooltip.hover title="Restore" width="30px" @click="restoreNote(bin_note)">
								        	</div>
								        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
								        		<img :src="deleteForeverImg" v-b-tooltip.hover title="Delete Forever" width="30px" @click="deleteForever(bin_note)">
								        	</div>
								        </div>
								    </b-card>
								</div>
							</template>
							<template v-else>
								<div class="col-md-3">
									<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;" :style="{ 'background-color': bin_note.color_code }">
										<h5 style="font-family: Nexa;"><b>{{ bin_note.note_name | truncate(25) }}</b></h5>
								        <div class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
								            <table>
								            	<tr v-for="list in lists" v-if="list.note_id === bin_note.note_id">
								            		<td>
								            			<input type="checkbox" style="cursor: no-drop;" v-if="list.is_completed === 1" checked disabled>
								            			<input type="checkbox" style="cursor: no-drop;" v-else-if="list.is_completed === 0" disabled>
								            		</td>
								            		<td>
								            			<h6 :class="completed" v-if="list.is_completed === 1">{{ list.list_desc }}</h6>
								            			<h6 v-else-if="list.is_completed === 0">{{ list.list_desc }}</h6>
								            		</td>
								            	</tr>
								            </table>
								        </div>
								        <br>
								        <div>
								        	<p style="margin-bottom: 0px; text-align: center;" :style=" { 'background-color': bin_note.nb_label_color } ">{{ bin_note.nb_name }}</p>
								        </div>
								        <div style="text-align: left; margin-top: 5px;">
							        		<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
								        		<img :src="restoreImg" v-b-tooltip.hover title="Restore" width="30px" @click="restoreNote(bin_note)">
								        	</div>
								        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
								        		<img :src="deleteForeverImg" v-b-tooltip.hover title="Delete Forever" width="30px" @click="deleteForever(bin_note)">
								        	</div>
								        </div>
								    </b-card>
								</div>
							</template>
						</template>
					</template>
					<template v-else>
						
					</template>
				</div>
			</div>
			<leftsidebar @reloadBinNote="getBinnedNotes"></leftsidebar>
		</div>
	</div>
</template>

<script>
	import LeftSidebar from './LeftSidebar.vue';

	export default {
		data() {
			return {
				restoreImg: 'images/restore.png',
				deleteForeverImg: 'images/delete_forever.png',
				bin_note_list: [],
				lists: [],
				testId: '1',
				completed: 'completed'
			}
		},

		components: {
			'leftsidebar': LeftSidebar
		},

		created() {
			this.getBinnedNotes();
		},

		methods: {
			getBinnedNotes() {
				axios.get('bin/get_notes')
				.then(response => {
					this.bin_note_list = response.data.bin_note_list;
					this.lists = response.data.lists;
				});
			},

			restoreNote(note) {
				axios.post('bin/restore_note', {
					binNoteId: note.id,
					noteId: note.note_id
				})
				.then(response => {
					this.getBinnedNotes();
					this.restoredToast();
				});
			},

			deleteForever(note) {
				axios.post('bin/delete_note', {
					binNoteId: note.id,
					noteId: note.note_id
				})
				.then(response => {
					this.getBinnedNotes();
					this.deleteForeverToast();
				});
			},

			restoredToast() {
				let toast = this.$toasted.show("<b>Note restored</b>", { 
					theme: "primary", 
					position: "bottom-left",
					duration : 2500
				});
			},

			emptyBinToast() {
				let toast = this.$toasted.show("<b>Bin is now empty</b>", { 
					theme: "primary", 
					position: "bottom-left",
					duration : 2500
				});
			},

			deleteForeverToast() {
				let toast = this.$toasted.show("<b>You permanently deleted this note</b>", { 
					theme: "primary", 
					position: "bottom-left",
					duration : 2500
				});
			},

			emptyBin() {
				axios.post('bin/empty_bin')
				.then(response => {
					this.getBinnedNotes();
					this.emptyBinToast();
				});
			}
		}
	};
</script>

<style>
	.completed {
		text-decoration: line-through;
		color: grey;
	}
</style>