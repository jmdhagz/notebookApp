<template>
	<div>
		<div class="ml-auto">
			<button class="btn btn-primary" v-b-modal="'createModal'">Add Item</button>
		</div>
		<br>
		<table class="table" width="100%">
			<thead>
				<tr>
					<th width="5%">ID</th>
					<th width="20%">Name</th>
					<th width="50%">Description</th>
					<th width="25%">Action</th>
				</tr>
				<tr v-for="item in items" v-bind:key="item.id">
					<td>{{ item.id }}</td>
					<td>{{ item.name }}</td>
					<td>{{ item.description }}</td>
					<td>
						<button class="btn btn-primary" v-b-modal="'editModal'" @click="editItem(item)">
							Edit
						</button>
						<button class="btn btn-danger" @click="deleteItem(item.id)">
							Delete
						</button>
					</td>
				</tr>
			</thead>
		</table>

		<b-modal id="createModal" hide-footer>
			<div class="d-block text-center">
        		<h3>Create Item</h3>
      		</div>
   			<form @submit.prevent="saveItem" class="mb-3">
				<div class="form-group">
					<input type="text" name="name" class="form-control" v-model="item.name">
				</div>
				<div class="form-group">
					<input type="text" name="description" class="form-control" v-model="item.description">
				</div>
				<button class="btn btn-primary btn-block" type="submit">Save</button>
			</form>
  		</b-modal>

		<b-modal id="editModal" hide-footer>
			<div class="d-block text-center">
        		<h3>Edit Item</h3>
      		</div>
   			<form @submit.prevent="saveItem" class="mb-3">
				<div class="form-group">
					<input type="text" name="name" class="form-control" v-model="item.name">
				</div>
				<div class="form-group">
					<input type="text" name="description" class="form-control" v-model="item.description">
				</div>
				<button class="btn btn-primary btn-block" type="submit">Save</button>
			</form>
  		</b-modal>
  </div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				items: [],
				item: {
					id: '',
					name: '',
					description: ''
				},
				item_id: '',
				edit: false
			};
		},
		// will run as the page loads
		created() {
			this.fetchItems();
		},

		methods: {
			fetchItems() {
				fetch('api/items')
					.then(res => res.json())
					.then(res => {
						this.items = res;
					});
			},

			saveItem() {
				if (this.edit === false) {
					// create function
					fetch('api/items/create', {
						method: "post",
						body: JSON.stringify(this.item),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(data => {
						this.item.name = '';
						this.item.description = '';
						alert('Item Added!');
						this.fetchItems();
					});
				}
				else {
					this.$http.get('api/items/edit', {
						method: "put",
						body: JSON.stringify(this.item),
						headers: {
							'content-type': 'application/json'
						}
					})
						.then(res => res.json())
						.then(data => {
							this.item.name = '';
							this.item.description = '';
							alert('Item Modified!');
							this.fetchItems();
						});
				}
			},

			deleteItem(id) {
				fetch(`api/items/delete/${id}`, {
					method: "delete"
				})
					.then(res => res.json())
					.then(data => {
						this.fetchItems();
					})
					.catch(err => console.log(err));
			},

			editItem(item) {
				// this.item.name refers to data variables and item.name refers to v-model property in inputs
				// needs to set edit into TRUE to enable editing the item
				this.edit = true;
				this.item.id = item.id;
				this.item.item_id = item.id;
				this.item.name = item.name;
				this.item.description = item.description;
			}
		}
	}
</script>