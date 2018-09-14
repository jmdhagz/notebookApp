<template>
	<div>
		<div style="margin-top: 50px;">
			<div class="col-md-12">
				<div style="margin-top: 10px;">
					<img :src="newNote" v-b-tooltip.hover title="New Note" v-b-modal.newNoteModal width="30px">
					<img :src="newList" v-b-tooltip.hover title="New List" v-b-modal.newListModal width="30px">
				</div>
			</div>
			<div class="col-md-12">
				<h1 style="word-wrap: break-word;">{{ notebookName }}</h1>
				<h3>Pinned</h3>
				<div class="row">
					<template v-for="pinnedNote in pinnedNoteList">
						<template v-if="pinnedNote.note_type_id === 1">
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;"  :style="{ 'background-color': pinnedNote.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ pinnedNote.note_name }}</b></h5>
									<p class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
										{{ pinnedNote.note_desc }}
									</p>
									<br>
									<div>
										<p style="margin-bottom: 0px; text-align: center; font-size: 14px;" :style=" { 'background-color': pinnedNote.nb_label_color } ">{{ pinnedNote.nb_name }}</p>
									</div>
									<div style="text-align: center;">
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinnedImg" v-b-tooltip.hover title="Unpin" width="20px" @click="unpinNote(pinnedNote.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(pinnedNote)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.noteInfoModal @click="getNoteInfo(pinnedNote)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="archiveImg" v-b-tooltip.hover title="Archive" width="20px" @click="archiveNote(pinnedNote.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(pinnedNote)">
							        	</div>
							        	<!-- <div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(pinned_note)">
							        	</div> -->
							        </div>
								</b-card>
							</div>
						</template>
						<template v-else>
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;"  :style="{ 'background-color': pinnedNote.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ pinnedNote.note_name }}</b></h5>
									<div class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
										<table>
											<tr v-for="list in noteList">
												<template v-if="list.note_id === pinnedNote.id">
													<td>
														<input type="checkbox" @click="checkboxToggle(list.id, $event)" v-if="list.is_completed === 1" checked>
														<input type="checkbox" @click="checkboxToggle(list.id, $event)" v-else-if="list.is_completed === 0">
													</td>
													<td>
														<h6 :class="completed" v-if="list.is_completed === 1">{{ list.list_desc }}</h6>
														<h6 v-else-if="list.is_completed === 0">{{ list.list_desc }}</h6>
													</td>
												</template>
											</tr>
										</table>
									</div>
									<br>
									<div>
										<p style="margin-bottom: 0px; text-align: center; font-size: 14px;" :style=" { 'background-color': pinnedNote.nb_label_color } ">{{ pinnedNote.nb_name }}</p>
									</div>
									<div style="text-align: center;">
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinnedImg" v-b-tooltip.hover title="Unpin" width="20px" @click="unpinNote(pinnedNote.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(pinnedNote)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.listInfoModal @click="getListInfo(pinnedNote)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="archiveImg" v-b-tooltip.hover title="Archive" width="20px" @click="archiveNote(pinnedNote.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" v-b-modal.collaborateModal @click="binNote(pinnedNote.id)">
							        	</div>
							        	<!-- <div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(pinned_note)">
							        	</div> -->
							        </div>
								</b-card>
							</div>
						</template>
					</template>
				</div>
				<hr>
				<h3>Others</h3>
				<div class="row">
					<template v-for="unpinnedNote in unpinnedNoteList">
						<template v-if="unpinnedNote.note_type_id === 1">
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;"  :style="{ 'background-color': unpinnedNote.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ unpinnedNote.note_name }}</b></h5>
									<p class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
										{{ unpinnedNote.note_desc }}
									</p>
									<br>
									<div>
										<p style="margin-bottom: 0px; text-align: center; font-size: 14px;" :style=" { 'background-color': unpinnedNote.nb_label_color } ">{{ unpinnedNote.nb_name }}</p>
									</div>
									<div style="text-align: center;">
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinImg" width="20px" v-b-tooltip.hover title="Pin" v-b-modal.collaborateModal @click="pinNote(unpinnedNote.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" width="20px" v-b-tooltip.hover title="Color" v-b-modal.colorModal @click="selectColor(unpinnedNote)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" width="20px" v-b-tooltip.hover title="Edit" v-b-modal.noteInfoModal @click="getNoteInfo(unpinnedNote)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="archiveImg" width="20px"  v-b-tooltip.hover title="Archive" @click="archiveNote(unpinnedNote.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" width="20px" v-b-tooltip.hover title="Delete" v-b-modal.collaborateModal @click="binNote(unpinnedNote.id)">
							        	</div>
							        	<!-- <div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="moreImg" width="20px" v-b-modal.collaborateModal @click="getNoteInfo(pinned_note)">
							        	</div> -->
							        </div>
								</b-card>
							</div>
						</template>
						<template v-else>
							<div class="col-md-3">
								<b-card style="height: auto; min-height: 300px; margin-bottom: 20px;"  :style="{ 'background-color': unpinnedNote.color_code }">
									<h5 style="font-family: Nexa;"><b>{{ unpinnedNote.note_name }}</b></h5>
									<div class="card-text" style="overflow-y: auto; height: 220px; margin-right: -10px; margin-bottom: 0px; font-family: RailWayRegular;">
										<table>
											<tr v-for="list in noteList">
												<template v-if="list.note_id === unpinnedNote.id">
													<td>
														<input type="checkbox" @click="checkboxToggle(list.id, $event)" v-if="list.is_completed === 1" checked>
														<input type="checkbox" @click="checkboxToggle(list.id, $event)" v-else-if="list.is_completed === 0">
													</td>
													<td>
														<h6 :class="completed" v-if="list.is_completed === 1">{{ list.list_desc }}</h6>
														<h6 v-else-if="list.is_completed === 0">{{ list.list_desc }}</h6>
													</td>
												</template>
											</tr>
										</table>
									</div>
									<br>
									<div>
										<p style="margin-bottom: 0px; text-align: center; font-size: 14px;" :style=" { 'background-color': unpinnedNote.nb_label_color } ">{{ unpinnedNote.nb_name }}</p>
									</div>
									<div style="text-align: center;">
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pinImg" v-b-tooltip.hover title="Pin" width="20px" v-b-modal.collaborateModal @click="pinNote(unpinnedNote.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="paintImg" v-b-tooltip.hover title="Color" width="20px" v-b-modal.colorModal @click="selectColor(unpinnedNote)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="pencilImg" v-b-tooltip.hover title="Edit" width="20px" v-b-modal.listInfoModal @click="getListInfo(unpinnedNote)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline; padding-right: 10px;">
							        		<img :src="archiveImg" v-b-tooltip.hover title="Archive" width="20px" @click="archiveNote(unpinnedNote.id)">
							        	</div>
							        	<div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="trashImg" v-b-tooltip.hover title="Delete" width="20px" v-b-modal.collaborateModal @click="binNote(unpinnedNote.id)">
							        	</div>
							        	<!-- <div style="text-align: center; width: 50px; display: inline;">
							        		<img :src="moreImg" width="15px" v-b-modal.collaborateModal @click="getNoteInfo(pinned_note)">
							        	</div> -->
							        </div>
								</b-card>
							</div>
						</template>
					</template>
				</div>
				<visitednotebooksidebar @reloadPinnedList="getNotes" :notebookId="notebookId"></visitednotebooksidebar>
			</div>

			<b-modal id="colorModal" ref="colorModal" title="Select Color" size="sm" hide-footer>
				<div style="text-align: center;">
					<div v-for="color_list in color_lists" style="text-align: center; width: 50px; display: inline; padding-right: 5px;">
						<button class="btn" style="border-radius: 1.30em;" :style="{ 'background-color': color_list.color_code }" @click="saveColor(color_list.id)">&nbsp;&nbsp;&nbsp;</button>
					</div>
					<div>&nbsp;</div>
				</div>
			</b-modal>
	
			<b-modal id="noteInfoModal" ref="noteInfoModal" title="Edit Note" size="sm" hide-footer>
				<form @submit.prevent="saveEditNote(noteInfo)">
					<div class="form-group">
						<label class="control-label">Note Name</label>
						<input type="text" class="form-control" name="edit_note_name" v-model="noteInfo.note_name">
					</div>
					<div class="form-group">
						<label class="control-label">Description</label>
						<textarea class="form-control" name="edit_note_desc" v-model="noteInfo.note_desc" rows="5"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary col-md-12">Save</button>
					</div>
				</form>
			</b-modal>
			
			<!-- New Note Modal -->
			<b-modal id="newNoteModal" ref="newNoteModal" title="New Note" size="sm" hide-footer>
				<form @submit.prevent="saveNewNote(noteInfo)">
					<div class="form-group">
						<label class="control-label">Note Name</label>
						<input type="text" class="form-control" name="note_name" v-model="noteInfo.note_name" required>
					</div>
					<div class="form-group">
						<label class="control-label">Description</label>
						<textarea class="form-control" name="note_desc" v-model="noteInfo.note_desc" rows="5" required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary col-md-12">Save</button>
					</div>
				</form>
			</b-modal>

			<!-- New NoteList Modal -->
			<b-modal id="newListModal" ref="newListModal" title="New List" size="sm" hide-footer>
				<div class="form-group">
					<label class="control-label">List Name</label>
					<input type="text" class="form-control" name="new_list_name" v-model="new_list_name">
				</div>
				<table>
	            	<tr>
	            		<td>
	            			<button type="button" class="btn btn-primary" @click="addNewList()">ADD</button>
	            		</td>
	            		<td>
	            			<input type="text" class="form-control" v-model="addList">
	            		</td>
	            	</tr>
	            </table>
	            
	            <table style="margin-top: 15px;">
					<tr v-for="(newlyList, index) in listToBeCreated">
						<td>
	            			<input type="text" class="form-control" v-model="newlyList.new_list">
	            		</td>
	            		<td>
	            			<button type="button" class="btn btn-danger" @click="deleteNewList(index)">Delete</button>
	            		</td>
					</tr>
				</table>
				<div v-if="listToBeCreated.length > 0">
					<button class="btn btn-primary col-md-12" @click="saveNewList()">SAVE</button>
				</div>
				<div v-else="listToBeCreated.length === 0">
					
				</div>
			</b-modal>

			<!-- Edit list modal -->
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
	            	<tr v-for="list in noteList" v-if="list.note_id === note_list_id">
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
	</div>
</template>

<script>
	import VisitedNotebookLeftSidebar from './VisitedNotebookSidebar.vue';

	export default {
		props: ['notebook', 'notebook_id'],
		data() {
			return {
				notebookId: this.notebook_id,
				noteId: '',
				notebookName: this.notebook.nb_name,
				pinnedNoteList: [],
				unpinnedNoteList: [],
				noteList: [],
				color_lists: [],
				lists: [],
				note_list_id: '',
				note_list_name: '',
				addList: '',
				new_list_name: '',
				binnedNoteId: '',
				archivedNoteId: '',
				noteInfo: {
					id: '',
					note_name: '',
					note_desc: ''
				},
				errors: [],
				listToBeCreated: [],
				form_errors: this.errors,
				completed: 'completed',
				pinImg: '../images/pinned.png',
				paintImg: '../images/paint.png',
				pencilImg: '../images/pencil.png',
				colaborateImg: '../images/colaborate.png',
				archiveImg: '../images/archive.png',
				moreImg: '../images/more.png',
				trashImg: '../images/trash.png',
				pinnedImg: '../images/star.png',
				newNote: '../images/new_note.png',
				newList: '../images/new_list.png'
			}
		},

		component: {
			'visitednotebooksidebar': VisitedNotebookLeftSidebar
		},

		created() {
			this.getNotes();
			this.getColors();
		},

		methods: {
			getNotes() {
				axios({
					method: 'get',
					url: '../visited_notebook/'+this.notebookId+'/get_pinned_note'
				})
				.then(response => {
					this.pinnedNoteList = response.data.pinned_notes,
					this.unpinnedNoteList = response.data.unpinned_notes
					this.noteList = response.data.note_list
				});
			},

			selectColor(note) {
				this.noteId = note.id;
			},

			getColors() {
				axios.get('../get_colors').then(response => this.color_lists = response.data);
			},

			saveColor(colorId) {
				axios.post('../change_color', {
					noteId: this.noteId,
					colorId: colorId
				})
				.then(response => {
					this.getNotes();
					// this.getUnpinnedNotes();
					this.$refs.colorModal.hide();
				});
			},

			checkboxToggle(id, event) {
				if (event.target.checked) {
					axios.post('../post_check_list', {
						listId: id,
						status: 'checked'
					})
					.then(response => {
						this.getNotes();
					});
				}
				else {
					axios.post('../post_check_list', {
						listId: id,
						status: 'unchecked'
					})
					.then(response => {
						this.getNotes();
					});
				}
			},

			getNoteInfo(note) {
				this.noteInfo.id = note.id;
				this.noteInfo.note_name = note.note_name;
				this.noteInfo.note_desc = note.note_desc;
			},

			getListInfo(note) {
				this.note_list_id = note.id;
				this.note_list_name = note.note_name;
			},

			saveEditNote(note) {
				axios.post('../edit_note', {
					noteId: note.id,
					noteName: note.note_name,
					noteDesc: note.note_desc
				})
				.then(response => {
					this.getNotes();
					this.$refs.noteInfoModal.hide();
				});
			},

			archiveNote(note_id) {
				this.archivedNoteId = note_id;
				axios.post('../archive_note', {
					noteId: note_id
				})
				.then(response => {
					this.getNotes();
					this.archivedToastNotification();
				});
			},

			deleteNoteList(id) {
				axios.post('../list/delete_list', {
					listId: id
				})
				.then(response => {
					this.getNotes();
				});
			},

			editList(list) {
				axios.post('../list/edit_list', {
					listId: list.id,
					listDesc: list.list_desc
				})
				.then(response => {
					this.getNotes();
				});
			},

			binNote(id) {
				this.binnedNoteId = id;
				axios.post('../bin_note', {
					noteId: id
				})
				.then(response => {
					this.getNotes();		
					this.deleteToastNotification();		
				});
			},

			pinNote(id) {
				axios.post('../pin_unpin_note', {
					noteId: id,
					status: 'pin'
				})
				.then(response => {
					this.getNotes();
				});
			},

			unpinNote(id) {
				axios.post('../pin_unpin_note', {
					noteId: id,
					status: 'unpin'
				})
				.then(response => {
					this.getNotes();
				});
			},

			saveNewNote(noteInfo) {
				axios.post('../visited_notebook/new_note', {
					notebookId: this.notebookId,
					noteName: noteInfo.note_name,
					noteDesc: noteInfo.note_desc
				})
				.then(response => {
					this.getNotes();
					this.noteInfo.note_name = '',
					this.noteInfo.note_desc = '',
					this.$refs.newNoteModal.hide();
				})
				.catch(error => {
					this.errors = error.response.data;
				});
			},

			addNewList() {
				if (this.addList != '') {
					this.listToBeCreated.push({ new_list: this.addList });
					this.addList = '';
				}
			},

			deleteNewList(index) {
				this.listToBeCreated.splice(index, 1);
			},

			saveNewList() {
				axios.post('../visited_notebook/newList', {
					notebookId: this.notebookId,
					listName: this.new_list_name,
					listArr: this.listToBeCreated
				})
				.then(response => {
					this.getNotes();
					this.$refs.newListModal.hide();
				});
			},

			addEdittedList() {
				axios.post('../list/new_list_for_edit', {
					noteId: this.note_list_id,
					listDesc: this.addList
				})
				.then(response => {
					this.getNotes();
					this.addList = '';
				});
			},

			editNoteListName() {
				axios.post('../list/edit_notelist_name', {
					noteId: this.note_list_id,
					noteName: this.note_list_name
				})
				.then(response => {
					this.getNotes();
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
				axios.post('../undo_archived_note', {
					noteId: this.archivedNoteId
				})
				.then(response => {
					this.getNotes();
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
				axios.post('../undo_binned_note', {
					noteId: this.binnedNoteId
				})
				.then(response => {
					this.getNotes();
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