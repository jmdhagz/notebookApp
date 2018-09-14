<template>
	<div>
		<div style="margin-top: 50px;">
			<div class="col-md-12">
				<h1 style="font-family: Nexa"><b>ARCHIVE</b></h1>
				<br>
				<div class="row">
					<template v-for="archive_note in archive_notes">
						<template v-if="archive_note.note_type_id == 1">
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;" :style="{ 'background-color': archive_note.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ archive_note.note_name | truncate(25) }}</b></h5>
							        <p class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
							            {{ archive_note.note_desc }}
							        </p>
							        <br>
							        <div>
							        	<p style="margin-bottom: 0px; text-align: center; font-size: 14px;" :style=" { 'background-color': archive_note.nb_label_color } ">{{ archive_note.nb_name }}</p>
							        </div>
							        <div style="text-align: center;">
						        		<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinImg" v-b-tooltip.hover title="Pin" width="20px" @click="pinNote(archive_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(archive_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.noteInfoModal @click="getNoteInfo(archive_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="unarchiveImg" v-b-tooltip.hover title="Unarchive" width="20px" @click="unarchiveNote(archive_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" @click="binNote(archive_note.id)">
							        	</div>
							        	<!-- <div class="col-2" style="text-align: center;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(archive_note)">
							        	</div> -->
							        </div>
							    </b-card>
							</div>
						</template>
						<template v-else>	
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;" :style="{ 'background-color': archive_note.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ archive_note.note_name | truncate(25) }}</b></h5>
							        <div class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
							            <table>
							            	<tr v-for="list in lists" v-if="list.note_id === archive_note.id">
							            		<td>
							            			<input type="checkbox" @click="checkboxToggle(list.id, $event)" v-if="list.is_completed === 1" checked>
							            			<input type="checkbox" @click="checkboxToggle(list.id, $event)" v-else-if="list.is_completed === 0">
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
							        	<p style="margin-bottom: 0px; text-align: center;" :style=" { 'background-color': archive_note.nb_label_color } ">{{ archive_note.nb_name }}</p>
							        </div>
							        <div style="text-align: center;">
						        		<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinImg" v-b-tooltip.hover title="Pin" width="20px" @click="pinNote(archive_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(archive_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.listInfoModal @click="getListInfo(archive_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="unarchiveImg" v-b-tooltip.hover title="Unarchive" width="20px" @click="unarchiveNote(archive_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" @click="binNote(archive_note.id)">
							        	</div><!-- 
							        	<div class="col-2" style="text-align: center;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(archive_note_list)">
							        	</div> -->
							        </div>
							    </b-card>
							</div>
						</template>
					</template>
				</div>

				<b-modal id="colorModal" ref="colorModal" title="Select Color" size="sm" hide-footer>
					<div class="row">
						<div class="col-md-4" v-for="color_list in color_lists" style="text-align: center; margin-bottom: 10px;">
							<button class="btn" style="border-radius: 1.30em;" :style="{ 'background-color': color_list.color_code }" @click="saveColor(note_id, color_list.id)">&nbsp;&nbsp;&nbsp;</button>
						</div>
						<div>&nbsp;</div>
					</div>
				</b-modal>

				<b-modal id="noteInfoModal" ref="noteInfoModal" title="Edit Note" size="sm" hide-footer>
					<form @submit.prevent="saveEditNote(noteInfo.id)">
						<div class="form-group">
							<label class="control-label">Note Name</label>
							<input type="text" class="form-control" v-model="noteInfo.note_name">
						</div>
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control" v-model="noteInfo.note_desc"></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary col-md-12">Save</button>
						</div>
					</form>
				</b-modal>

				<b-modal id="listInfoModal" ref="listInfoModal" title="Edit Notes" size="sm" hide-footer>
					<div class="form-group">
						<label class="control-label">List Name</label>
						<input type="text" class="form-control" name="note_list_name" v-model="note_list_name" @change="editNoteListName()">
					</div>
					<table>
		            	<tr>
		            		<td>
		            			<button type="button" class="btn btn-primary" @click="addEdittedList()">ADD</button>
		            		</td>
		            		<td>
		            			<input type="text" class="form-control" v-model="addList">
		            		</td>
		            	</tr>
		            </table>
					<table>
		            	<tr v-for="list in lists" v-if="list.note_id === note_list_id">
		            		<td>
		            			<button class="btn btn-danger" @click="deleteNoteList(list.id)">Delete</button>
		            		</td>
		            		<td>
		            			<input type="text" class="form-control" name="list_desc" v-model="list.list_desc" @change="editList(list)">
		            		</td>
		            	</tr>
		            </table>
				</b-modal>

			</div>
			<leftsidebar @reloadPinnedList="getArchivedNotes"></leftsidebar>
		</div>
	</div>
</template>

<script>
	import LeftSidebar from './LeftSidebar.vue'; // include this file to get methods from this component PinnedNotes.vue

	export default {
		data() {
			return {
				paintImg: 'images/paint.png',
				pinImg: 'images/pinned.png',
				pencilImg: 'images/pencil.png',
				colaborateImg: 'images/colaborate.png',
				unarchiveImg: 'images/unarchive.png',
				moreImg: 'images/more.png',
				trashImg: 'images/trash.png',
				archiveIconPage: 'images/archive_page_icon.png',
				notebook_lists: [],
				archive_notes: [],
				archive_note_lists: [],
				lists: [],
				archiveNoteList: [],
				listCheckbox: '',
				addList: '',
				binnedNoteId: '',
				unarchivedNoteId: '',
				note_list_name: '',
				note_list_id: '',
				completed: 'completed',
				color_lists: [],
				note_id: '',
				pinned_note_id: '',
				noteInfo: {
					id: '',
					note_name: '',
					note_desc: ''
				},
			}
		},

		component: {
			'leftsidebar': LeftSidebar // display the template of this component which is the sidebar
		},

		created() {
			this.getArchivedNotes();
			this.getColors();
		},

		methods: {
			getArchivedNotes() {
				axios({
					method: 'get',
					url: 'archive/get_archive_note'
				})
					.then(response => {
						this.notebook_lists = response.data.notebook_list,
						this.archive_notes = response.data.archive_notes,
						this.lists = response.data.lists
					});
			},

			getListInfo(note) {
				this.note_list_id = note.id;
				this.note_list_name = note.note_name;
				this.pinned_note_id = note.id;
			},

			checkboxToggle(id, event) {
				if (event.target.checked) {
					axios.post('post_check_list', {
						listId: id,
						status: 'checked'
					})
					 .then(data => {
					 	this.getArchivedNotes();
					 });
				}
				else {
					axios.post('post_check_list', {
						listId: id,
						status: 'unchecked'
					})
					 .then(data => {
					 	this.getArchivedNotes();
					 });
				}
			},

			selectColor(archive_note) {
				this.note_id = archive_note.id;
			},

			saveColor(note_id, id) {
				axios.post('change_color', {
					noteId: note_id,
					colorId: id
				})
				.then(response => {
					this.getArchivedNotes();
					this.$refs.colorModal.hide();
				});
			},

			getNoteInfo(archive_note) {
				this.noteInfo.id = archive_note.id;
				this.noteInfo.note_name = archive_note.note_name;
				this.noteInfo.note_desc = archive_note.note_desc;
			},

			saveEditNote(id) {
				axios.post('archive/post_edit_note', {
					id: id,
					noteName: this.noteInfo.note_name,
					noteDesc: this.noteInfo.note_desc,
				})
				.then(response => {
					this.getArchivedNotes();
					this.$refs.noteInfoModal.hide();
				});
			},

			unarchiveNote(id) {
				this.unarchivedNoteId = id;
				axios.post('unarchive_note', {
					id: id
				})
				.then(response => {
					this.getArchivedNotes();
					this.unarchivedToastNotification();
				});
			},

			getColors() {
				axios.get('get_colors').then(response => this.color_lists = response.data);
			},

			pinNote(id) {
				axios.post('pin_unpin_note', {
					noteId: id,
					status: 'pin'
				})
				.then(response => {
					this.getArchivedNotes();
				});
			},

			deleteNoteList(id) {
				axios.post('list/delete_list', {
					listId: id
				})
				.then(response => {
					this.getArchivedNotes();
				});
			},

			editList(list) {
				axios.post('list/edit_list', {
					listId: list.id,
					listDesc: list.list_desc
				})
				.then(response => {
					this.getArchivedNotes();
				});
			},

			addEdittedList() {
				if (this.addList != '') {
					axios.post('list/new_list_for_edit', {
						noteId: this.note_list_id,
						listDesc: this.addList
					})
					.then(response => {
						this.getArchivedNotes();
						this.addList = '';
					});
				}
				else {
					
				}
			},

			editNoteListName() {
				axios.post('list/edit_notelist_name', {
					noteId: this.note_list_id,
					noteName: this.note_list_name
				})
				.then(response => {
					this.getArchivedNotes();
				});
			},

			binNote(id) {
				this.binnedNoteId = id;
				axios.post('bin_note', {
					noteId: id
				})
				.then(response => {
					this.getArchivedNotes();		
					this.deleteToastNotification();		
				});
			},

			deleteToastNotification() {
				let deleteToast = this.$toasted.show("<b>Note binned</b>", { 
					theme: "primary", 
					position: "bottom-left",
					action: [{
						text : 'Undo',
						onClick : (e, toastObject) => {
							this.undoBinned();
						}
					}],
					duration : 2500	
				});
			},

			undoToastNotification() {
				let undoToast = this.$toasted.show("<b>Action undone</b>", { 
					theme: "primary", 
					position: "bottom-left",
					duration : 2500	
				});
			},

			undoBinned() {
				axios.post('undo_binned_note', {
					noteId: this.binnedNoteId
				})
				.then(response => {
					this.getArchivedNotes();
					this.undoToastNotification();
				});
			},

			unarchivedToastNotification() {
				let deleteToast = this.$toasted.show("<b>Note unarchived</b>", { 
					theme: "primary", 
					position: "bottom-left",
					duration : 2500	
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