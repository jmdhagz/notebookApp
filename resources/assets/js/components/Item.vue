<template>
	<div>
		<h1>Create Item</h1>
		<form @submit.prevent="saveItem" class="mb-3">
			<div class="form-group">
				<input type="text" name="name" class="form-control" v-model="item.name">
			</div>
			<div class="form-group">
				<input type="text" name="description" class="form-control" v-model="item.description">
			</div>
			<button class="btn btn-primary btn-block" type="submit">Save</button>
		</form>
		<h2>Item List</h2>
		<div class="card card-body mb-4" v-for="item in items" v-bind:key="item.id">
			<h4 class="card-title">{{ item.name }}</h4>
			<p class="card-text">{{ item.description }}</p>
			<hr>
			<button @click="deleteItem(item.id)" class="btn btn-danger mb-3">Remove</button>
			<button @click="editItem(item)" class="btn btn-primary">Edit</button>
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

			deleteItem(id) {
				fetch(`api/items/delete/${id}`, {
					method: 'delete'
				})
				.then(res => res.json())
				.then(data => {
					alert('Item Removed!');
					this.fetchItems();
				})
				.catch(err => console.log(err));
			},

			saveItem() {
				if (this.edit === false) {
					fetch('api/items/create', {
						method: 'POST',
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
					})
					.catch(err => console.log(err));
				}
				else {
					fetch('api/items/edit', {
						method: 'PUT',
						body: JSON.stringify(this.item),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(data => {
						this.item.name = '';
						this.item.description = '';
						alert('Item Edited!');
						this.fetchItems();
					})
					.catch(err => console.log(err));
				}
			},

			editItem(item) {
				this.edit = true;
				this.item.id = item.id;
				this.item.item_id = item.id;
				this.item.name = item.name;
				this.item.description = item.description;
			}
		}
	};
</script>