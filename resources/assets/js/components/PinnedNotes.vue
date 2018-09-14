<template>
	<div>	
		<div style="margin-top: 50px;">
			<div class="col-md-12">
				<h1 style="font-family: Nexa;"><b>PINNED</b></h1>
				<br>
				<div class="row">
					<template v-for="pinned_note in pinned_notes">
						<template v-if="pinned_note.note_type_id === 1">
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;" :style="{ 'background-color': pinned_note.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ pinned_note.note_name }}</b></h5>
							        <p class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
							            {{ pinned_note.note_desc }}
							        </p>
							        <br>
							        <div>
							        	<p style="margin-bottom: 0px; text-align: center; font-size: 14px;" :style=" { 'background-color': pinned_note.nb_label_color } ">{{ pinned_note.nb_name }}</p>
							        </div>
							        <div style="text-align: center;">
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinnedImg" v-b-tooltip.hover title="Unpin" width="20px" @click="unpinNote(pinned_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(pinned_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.noteInfoModal @click="getNoteInfo(pinned_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="archiveImg" v-b-tooltip.hover title="Archive" width="20px" @click="archiveNote(pinned_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" @click="binNote(pinned_note.id)">
							        	</div>
							        	<!-- <div class="col-2" style="text-align: center;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(pinned_note)">
							        	</div> -->
							        </div>
							    </b-card>
							</div>
						</template>
						<template v-else>
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;" :style="{ 'background-color': pinned_note.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ pinned_note.note_name }}</b></h5>
							        <div class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
							            <table>
							            	<tr v-for="list in lists" v-if="list.note_id === pinned_note.id">
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
							        	<p style="margin-bottom: 0px; text-align: center;" :style=" { 'background-color': pinned_note.nb_label_color } ">{{ pinned_note.nb_name }}</p>
							        </div>
							        <div style="text-align: center;">
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinnedImg" v-b-tooltip.hover title="Unpin" width="20px" @click="unpinNote(pinned_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(pinned_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.listInfoModal @click="getListInfo(pinned_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="archiveImg" v-b-tooltip.hover title="Archive" width="20px" @click="archiveNote(pinned_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" @click="binNote(pinned_note.id)">
							        	</div><!-- 
							        	<div class="col-2" style="text-align: center;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(pinned_note_list)">
							        	</div> -->
							        </div>
							    </b-card>
							</div>
						</template>
					</template>
				</div>
				<hr>
				<h1 style="font-family: Nexa;"><b>OTHERS</b></h1>
				<br>
				<div class="row">
					<template v-for="unpinned_note in unpinned_notes">
						<template v-if="unpinned_note.note_type_id === 1">
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;" :style="{ 'background-color': unpinned_note.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ unpinned_note.note_name }}</b></h5>
							        <p class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
							            {{ unpinned_note.note_desc }}
							        </p>
							        <br>
							        <div>
							        	<p style="margin-bottom: 0px; text-align: center; font-size: 14px;" :style=" { 'background-color': unpinned_note.nb_label_color } ">{{ unpinned_note.nb_name }}</p>
							        </div>
							        <div style="text-align: center;">
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinImg" v-b-tooltip.hover title="Pin" width="20px" @click="pinNote(unpinned_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(unpinned_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.noteInfoModal @click="getNoteInfo(unpinned_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="archiveImg" v-b-tooltip.hover title="Archive" width="20px" @click="archiveNote(unpinned_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" @click="binNote(unpinned_note.id)">
							        	</div>
							        	<!-- <div class="col-2" style="text-align: center;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(pinned_note)">
							        	</div> -->
							        </div>
							    </b-card>
							</div>
						</template>
						<template v-else>
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;" :style="{ 'background-color': unpinned_note.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ unpinned_note.note_name }}</b></h5>
							        <div class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
							            <table>
							            	<tr v-for="list in lists" v-if="list.note_id === unpinned_note.id">
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
							        	<p style="margin-bottom: 0px; text-align: center;" :style=" { 'background-color': unpinned_note.nb_label_color } ">{{ unpinned_note.nb_name }}</p>
							        </div>
							        <div style="text-align: center;">
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinImg" v-b-tooltip.hover title="Pin" width="20px" @click="pinNote(unpinned_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(unpinned_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.listInfoModal @click="getListInfo(unpinned_note)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="archiveImg" v-b-tooltip.hover title="Archive" width="20px" @click="archiveNote(unpinned_note.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" @click="binNote(unpinned_note.id)">
							        	</div><!-- 
							        	<div class="col-2" style="text-align: center;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(pinned_note_list)">
							        	</div> -->
							        </div>
							    </b-card>
							</div>
						</template>
					</template>
				</div>
			</div>
			


			<b-modal id="colorModal" ref="colorModal" title="Select Color" size="sm" hide-footer>
				<div style="text-align: center;">
					<div v-for="color_list in color_lists" style="text-align: center; width: 50px; display: inline; padding-right: 5px;">
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
						<textarea class="form-control" v-model="noteInfo.note_desc" rows="5"></textarea>
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

			<b-modal id="collaborateModal" ref="collaborateModal" @shown="getCollaborators()" title="Collaborate" size="md" hide-footer>
				<div class="form-group">
					<label class="control-label">Note Name</label>
					<typeahead :lists="collaboratorList" v-model="selected" @selectedColaborator="selectList('test', ...arguments)"></typeahead>
				</div>
			</b-modal>

			<leftsidebar @reloadPinnedList="getPinnedNotes" @reloadUnpinnedList="getUnpinnedNotes"></leftsidebar>
		</div>
	</div>
</template>

<script>
	import LeftSidebar from './LeftSidebar.vue'; // include this file to get methods from this component PinnedNotes.vue
	import Typeahead from './Typeahead.vue';

	export default {
		data() {
			return {
				paintImg: 'images/paint.png',
				pinImg: 'images/pinned.png',
				pinnedImg: 'images/star.png',
				pencilImg: 'images/pencil.png',
				colaborateImg: 'images/colaborate.png',
				archiveImg: 'images/archive.png',
				moreImg: 'images/more.png',
				trashImg: 'images/trash.png',
				notebook_lists: [],
				pinned_notes: [],
				pinned_note_lists: [],
				lists: [],
				unpinned_notes: [],
				unpinned_note_lists: [],
				unpinned_lists: [],
				addList: '',
				note_list_id: '',
				note_list_name: '',
				listCheckbox: '',
				completed: 'completed',
				color_lists: [],
				note_id: '',
				binnedNoteId: '',
				archivedNoteId: '',
				noteInfo: {
					id: '',
					note_name: '',
					note_desc: ''
				},
				pinned_note_id: '',
				selected: null,
				options: [
					{id: 1, text: 'Apple'},
					{id: 2, text: 'Mango'},
					{id: 3, text: 'Cherry'},
					{id: 4, text: 'Orange'},
					{id: 21, text: 'Appl22e'},
					{id: 22, text: 'Mang2o'},
					{id: 23, text: 'Cher2ry'},
					{id: 24, text: 'Oran2ge'},
					{id: 41, text: 'A4pple'},
					{id: 42, text: 'Ma4ngo'},
					{id: 43, text: 'Ch4erry'},
					{id: 44, text: 'Ora4nge'}
				],
				collaboratorList: []
			}
		},

		component: {
			'leftsidebar': LeftSidebar,
			'typeahead': Typeahead  // display the template of this component which is the sidebar
		},

		created() {
			this.getPinnedNotes();
			// this.getUnpinnedNotes();
			this.getColors();
		},

		methods: {
			getPinnedNotes() {
				axios({
					method: 'get',
					url: 'dashboard/get_pinned_notes'
				})
					.then(response => {
						this.notebook_lists = response.data.notebook_list,
						this.pinned_notes = response.data.pinned_notes,
						this.unpinned_notes = response.data.unpinned_notes,
						this.pinned_note_lists = response.data.pinned_note_list,
						this.lists = response.data.lists
					});
			},

			getNote(note)
			{
				this.note_id = note.id;
			},

			// Collaborate

			selectList(extra, id)
			{
				alert(id);
			},

			getCollaborators() {
				axios.get('collaborate/get_collaborators').then(response => this.collaboratorList = response.data);
			},

			getUnpinnedNotes() {
				axios({
					method: 'get',
					url: 'dashboard/get_unpinned_notes'
				})
					.then(response => {
						this.notebook_lists = response.data.notebook_list,
						this.unpinned_notes = response.data.unpinned_notes,
						this.unpinned_note_lists = response.data.unpinned_note_lists,
						this.unpinned_lists = response.data.unpinned_lists
					});
			},

			getResponse: function (response) {
		    	return response.data.items
	      	},

			checkboxToggle(id, event) {
				if (event.target.checked) {
					axios.post('post_check_list', {
						listId: id,
						status: 'checked'
					})
					 .then(data => {
					 	this.getPinnedNotes();
					 	this.getUnpinnedNotes();
					 });
				}
				else {
					axios.post('post_check_list', {
						listId: id,
						status: 'unchecked'
					})
					 .then(data => {
					 	this.getPinnedNotes();
					 	this.getUnpinnedNotes();
					 });
				}
			},

			selectColor(pinned_note) {
				this.note_id = pinned_note.id;
			},

			saveColor(note_id, id) {
				axios.post('change_color', {
					noteId: note_id,
					colorId: id
				})
				.then(response => {
					this.getPinnedNotes();
					this.getUnpinnedNotes();
					this.$refs.colorModal.hide();
				});
			},

			getColors() {
				axios.get('get_colors').then(response => this.color_lists = response.data);
			},

			getNoteInfo(pinned_note) {
				this.noteInfo.id = pinned_note.id;
				this.noteInfo.note_name = pinned_note.note_name;
				this.noteInfo.note_desc = pinned_note.note_desc;
			},

			saveEditNote(id) {
				axios.post('edit_note', {
					noteId: id,
					noteName: this.noteInfo.note_name,
					noteDesc: this.noteInfo.note_desc,
				})
				.then(response => {
					this.getPinnedNotes();
					this.getUnpinnedNotes();
					this.$refs.noteInfoModal.hide();
				});
			},

			getListInfo(note) {
				this.note_list_id = note.id;
				this.note_list_name = note.note_name;
			},

			archiveNote(id) {
				this.archivedNoteId = id;
				axios.post('archive_note', {
					noteId: id
				})
				.then(response => {
					this.getPinnedNotes();
					this.getUnpinnedNotes();
					this.archivedToastNotification();
				});
			},

			pinNote(id) {
				axios.post('pin_unpin_note', {
					noteId: id,
					status: 'pin'
				})
				.then(response => {
					this.getPinnedNotes();
				});
			},

			unpinNote(id) {
				axios.post('pin_unpin_note', {
					noteId: id,
					status: 'unpin'
				})
				.then(response => {
					this.getPinnedNotes();
				});
			},

			deleteNoteList(id) {
				axios.post('list/delete_list', {
					listId: id
				})
				.then(response => {
					this.getPinnedNotes();
				});
			},

			editList(list) {
				axios.post('list/edit_list', {
					listId: list.id,
					listDesc: list.list_desc
				})
				.then(response => {
					this.getPinnedNotes();
				});
			},

			addEdittedList() {
				if (this.addList != '') {
					axios.post('list/new_list_for_edit', {
						noteId: this.note_list_id,
						listDesc: this.addList
					})
					.then(response => {
						this.getPinnedNotes();
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
					this.getPinnedNotes();
				});
			},

			binNote(id) {
				this.binnedNoteId = id;
				axios.post('bin_note', {
					noteId: id
				})
				.then(response => {
					this.getPinnedNotes();
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

			archivedToastNotification() {
				let deleteToast = this.$toasted.show("<b>Note archived</b>", { 
					theme: "primary", 
					position: "bottom-left",
					action: [{
						text : 'Undo',
						onClick : (e, toastObject) => {
							this.undoArchived();
						}
					}],
					duration : 2500	
				});
			},

			undoArchived() {
				axios.post('undo_archived_note', {
					noteId: this.archivedNoteId
				})
				.then(response => {
					this.getPinnedNotes();
					this.undoToastNotification();
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
					this.getPinnedNotes();
					this.undoToastNotification();
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
