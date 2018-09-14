<template>
	<div>
		<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
			<a class="navbar-brand" style="font-family: Nexa; color: white;"><b>NOTEBOOK APP</b></a>
			<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

			<b-collapse is-nav id="nav_collapse">
				<b-navbar-nav>
				   	<ul class="navbar-nav navbar-sidenav" id="exampleAccordion" style="background-color: #E8E8E8 !important;">
				      	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
				         	<a class="nav-link" :href="pinnedUrl">
				            	<table>
				            		<tr>
				            			<td width="20%"><img :src="pinnedImg" width="60%"></td>
				            			<td width="70%" style="color: #282828;">All Pinned</td>
				            		</tr>
				            	</table>
				         	</a>
				      	</li>
				      	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
					        <a class="nav-link">
					        	<table width="100%">
				            		<tr>
				            			<td width="70%" style="font-family: Nexa"><b>NOTEBOOK</b></td>
				            		</tr>
				            	</table>
					        </a>
					    </li>
					    <li class="nav-item" v-for="notebook in notebooks">
					        <a class="nav-link">
					        	<table width="100%">
				            		<tr>
				            			<td width="20%"><img :src="notebookImg" width="60%"></td>
				            			<td width="70%" @click="visitNotebook(notebook.id)">{{ notebook.nb_name }}</td>
				            		</tr>
				            	</table>
					        </a>
					    </li>
				      	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
				         	<a class="nav-link" v-b-modal.modal1>
				            	<tr>
			            			<td width="20%"><img :src="addImg" width="60%"></td>
			            			<td width="70%"><span class="nav-link-text">Create New Notebook</span></td>
			            		</tr>
				         	</a>
				      	</li>
				      	<hr style="border: 1px solid #d1d1d1; width: 80%;">
				      	<li class="nav-item" data-toggle="tooltip" data-placement="right">
				         	<a class="nav-link" :href="archiveUrl">
				            	<tr>
			            			<td width="20%"><img :src="archiveImg" width="60%"></td>
			            			<td width="70%" style="color: #282828;">
			            				<span class="nav-link-text">Archive</span>
			            			</td>
			            		</tr>
				         	</a>
				      	</li>
				     	<li class="nav-item" data-toggle="tooltip" data-placement="right">
				         	<a class="nav-link" :href="binUrl">
				            	<tr>
			            			<td width="20%"><img :src="trashImg" width="60%"></td>
			            			<td width="70%" style="color: #282828;">
			            				<span class="nav-link-text">Bin</span>
			            			</td>
			            		</tr>
				         	</a>
				      	</li>
				   	</ul>
				</b-navbar-nav>
			</b-collapse>
		</nav>

		<b-modal id="modal1" ref="modal1" title="Create New Notebook" size="sm" hide-footer>
			<form @submit.prevent="saveNotebook">
				<div class="form-group">
					<label class="control-label">Notebook Name</label>
					<input type="text" class="form-control" name="notebook_name" v-model="notebook_name">
				</div>
				<div class="form-group">
					<button class="btn btn-primary col-md-12" type="submit">Save</button>
				</div>
			</form>
			<table width="100%">
				<tr v-for="notebook in notebooks">
					<td width="70%">
						<input type="text" class="form-control" v-model="notebook.nb_name" @change="changeName(notebook)">
					</td>
					<td width="10%">&nbsp;</td>
					<td width="20%">
						<button type="button" class="btn btn-sm btn-danger" @click="deleteNotebook(notebook.id)">
							Delete
						</button>
					</td>
				</tr>
			</table>
		</b-modal>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				addImg: 'images/add.png',
				pinnedImg: 'images/pinned.png',
				notebookImg: 'images/book.png',
				archiveImg: 'images/archive.png',
				trashImg: 'images/trash.png',
				notebook_name: '',
				pinnedUrl: 'vue-notebook-app/public/',
				notebooks: [],
				archiveUrl: 'vue-notebook-app/public/archive/',
				binUrl: 'vue-notebook-app/public/bin/'
			}
		},

		created() {
			this.getNotebook();
		},

		methods: {
			saveNotebook() {
				axios.post('dashboard/new_notebook', {
					notebookName: this.notebook_name
				})
					.then(data => { // .done in jquery
						this.$refs.modal1.hide();
						this.getNotebook();
					});
			},

			getArchivedNotes() {
				this.$emit('applied');
			},

			// getPinnedNotes() {
			// 	this.$emit('applied');
			// },

			// getUnpinnedNotes() {
			// 	this.$emit('applied');
			// },

			getNotebook() {
				axios.get('dashboard/get_notebooks').then(response => this.notebooks = response.data);
			},

			updateNotebook(notebook) {
				alert(notebook.nb_name);
			},

			deleteNotebook(id) {
				axios.post('dashboard/delete_notebook', {
					id: id
				})
				.then(response => {
					this.getNotebook();
					this.$emit('reloadPinnedList');
					this.$emit('reloadUnpinnedList');
					this.$emit('reloadBinNote');
				});
			},

			changeName(notebook) {
				axios.post('dashboard/edit_notebook', {
					id: notebook.id,
					nb_name: notebook.nb_name
				})
				.then(response => {
					this.getNotebook();
					this.$emit('reloadPinnedList');
					this.$emit('reloadUnpinnedList');
					this.$emit('reloadBinNote');
				});
			},

			visitNotebook(id) {
				window.location.href = 'visited_notebook/'+id;
			}

		}
	}
</script>