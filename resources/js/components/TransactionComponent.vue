<template>
<div>
	<div class="row">
		<div class="col-sm-3">
			<p>
				<label>Search For Product</label>
				<input @blur="hideProductList" v-model="product_search" autofocus placeholder=" search product name here" class="form-control">
			</p>
			<div class="text-center" v-show="searching">
				<i>Searching..</i>
			</div>
			<div class="text-center" v-show="nofound">
				<i>No Product Found</i>
			</div>
			<div v-for="product_list in product_lists" :key="product_list.id" class="product-list" style="line-height:1; padding:8px; border:1px solid #ccc; margin-bottom:5px;">
				<button  v-if="product_list.quantity > 0" type="button" tabindex="product_list.id" @click="addToList(product_list)" value="1" class=" btn btn-success text-white btn-sm float-end">Add</button>
				<label style="font-size:12px;  white-space: nowrap;">{{ product_list.name }}</label> <br>
				<small style="color:red" v-if="product_list.quantity.length < 1">OUT OF STOCK</small>
				<small>- P{{ parseFloat(product_list.price).toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") }}</small>
			</div>



		</div>
		<div class="col-sm-9">
			<div class="well" style="background-color:transparent">
			<div class="form-group">
				<label for="">Customer</label>
				<input type="text" required placeholder="customer name..." name="customer" class="form-control">
			</div>
			<table class="table table-stripped">
				<thead>
					<tr>
						<th><b>Product</b></th>
						<th><b>Price</b></th>
						<th width="5%"><b>Quantity</b></th>
						<th align="right"><b>Sub Price</b></th>
						<th align="right"></th>
						<th align="right"></th>
					</tr>
				</thead>
				<tbody>
				<tr v-for="(product, index) in selected_products" :key="index">
					<td>
						{{ product.name }}
						<input type="hidden" name="products[]" :value="product.id">
					</td>
					<td>P{{ parseFloat(product.price).toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") }}</td>
					<td>
						<span class="roller">
							<span class="roller-column">
								<button class="roller-btn" type="button"  @click="product.quantity > 1 ? product.quantity-- : product.quantity">-</button>
							</span>
							<span class="roller-column">
								<input name="quantities[]" min="1" :max="product.remaining"   v-model.number="product.quantity">
							</span>
							<span class="roller-column">
								<button class="roller-btn" type="button" :disabled="product.quantity >= product.remaining"  @click="product.quantity += 1">+</button>
							</span>
						</span>
					</td>
					<td>
						<strong>
						P{{ (product.price * product.quantity).toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") }}
						</strong>
					</td>
					<td align="right">
						<a type="button" class="btn btn-xs btn-danger text-white" @click="deleteProduct(index)"> Remove</a>
					</td>
				</tr>
				<tr v-if="selected_products < 1">
					<td align="center" colspan="5" > No Product in the Table, Search and select to start!</td>
				</tr>
				

				<tr v-if="selected_products.length > 0">
					<td></td>
					<td></td>
					<td>
						<b>SubTotal:</b>
					</td>
					<td> <strong>P{{ subtotal.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") }}</strong></td>
					<td></td>
				</tr>
				<tr v-if="selected_products.length > 0">
					<td></td>
					<td></td>
					<td>
						<b>Discount:</b>
					</td>
					<td>
						<input name="discount" class="form-control input-sm" style="width:180px" type="number" v-model.number="discount">
						<input type="checkbox" id="percentage" v-model="isPercentage"> <label for="percentage">% Percentage</label>
					</td>
					<td align="left"></td>
				</tr>
				
				<!-- <tr v-if="selected_products.length > 0">
					<td></td>
					<td></td>
					<td></td>
					<td>
						<label>
						<input type="checkbox" name="tax" v-model="tax" >
						{{vat_tax}}% Value Added Tax
						</label>
					</td>
					<td></td>
				</tr>
				<tr v-if="tax">
					<td></td>
					<td></td>
					<td>
						<b>Tax:</b>
					</td>
					<td>
						<strong>P{{ tax_amount.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") }}</strong>
					</td>
					<td></td>
				</tr> -->
				<!-- <tr v-if="tax">
					<td></td>
					<td></td>
					<td>
						<b>Taxable:</b>
					</td>
					<td>
						<strong>P{{ taxable_amount.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") }}</strong>
					</td>
					<td></td>
				</tr> -->
				<tr v-if="selected_products.length > 0">
					<td></td>
					<td></td>
					<td>
						<b>Total:</b>
					</td>
					<td>
						<strong>P{{ total.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") }}</strong>
					</td>
					<td></td>
				</tr>
				<tr v-if="selected_products.length > 0">
					<td></td>
					<td></td>
					<td>
						<b>Tendered Amount:</b>
					</td>
					<td>
						<input name="amount_tendered" class="form-control input-sm" style="width:180px" type="number" v-model.number="amount_tendered">
					</td>
					<td align="left"></td>
				</tr>
				<tr v-if="selected_products.length > 0">
					<td></td>
					<td></td>
					<td>
						<b>Change:</b>
					</td>
					<td>
						<span v-if="amount_tendered">
							<strong>P{{ change.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") }}</strong>
						</span>
					</td>
					<td align="left"></td>
				</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<br>
	<button v-if="selected_products.length > 0" type="submit" class="float-end btn btn-lg btn-success text-white no-radius"><i class="fa fa-save"></i> Submit</button>
</div>
</template>

<script>
	export default {
		props:['vat_tax'],
		data: function()
		{
			return {
				product_search: '',
				product_lists: '',
				searching: false,
				nofound: false,
				selected_products: [],
				isPercentage: false,
				discount: '',
				Error: '',
				tax: true,
				due: 0,
				amount_tendered: 0,
			}
		},
		computed:{
			subtotal(){
				return this.selected_products.reduce( (sum, product) => {
					return sum + product.price * product.quantity
				},0)
			},

			change(){
				return this.amount_tendered - this.total
			},

			totalTax()
			{
				return this.selected_products.reduce( (sum, product) => {
					return sum + product.tax
				},0)
			},

			total()
			{
				if(this.due){
					if(this.isPercentage){
						var percentage_amount = (this.subtotal + parseInt(this.due))  * this.discount / 100
						return (this.subtotal + parseInt(this.due)) - percentage_amount 
					}else{
						return (this.subtotal + parseInt(this.due) )- this.discount 
					}
				}else{
					if(this.isPercentage){
						var percentage_amount = (this.subtotal * this.discount) / 100
						return this.subtotal - percentage_amount 
					}else{
						return this.subtotal - this.discount 
					}
				}

				return 0;
			},
			tax_amount(){
				return this.total * this.vat_tax / 100;
			},
			taxable_amount(){
				return this.total - this.tax_amount;
			}
		},
		watch:{
			
			product_search: _.debounce(function() {
				if(this.product_search.length >= 3){
					if(this.product_lists){
						this.searching = true
						this.nofound = false
					}
					//search for product
					axios.post('/api/product/search', 
					{
						keyword: this.product_search
					})
					.then( (response) => {
						if(response.data.data.length > 0){
                            console.log(response.data)
							this.product_lists = response.data.data
							this.searching = false
							this.nofound = false
						}else{
							this.nofound = true
							this.searching = false
							this.product_lists = {}
						}
					})
					.catch((error) => {
						console.log(error)
						if(error == "Network Error"){
							location.reload();
						}
					})

				}else{

				}
			}, 250)
		},
		methods:{
			addToList(product){
				this.product_search = ''
				this.product_lists = ''
			
                var existing_product = _.find(this.selected_products, {product_id:product.id});
                if(existing_product)
                {
                    existing_product.quantity++
                }else{
                    this.selected_products.push(product)
                }
					
			},
			hideProductList()
			{
				setTimeout(function(){
					//this.product_lists == ''
				},5000)
			},
			deleteProduct(index){
				if(confirm("Are you sure to delete?"))
					this.selected_products.splice(index, 1);
			}
		},

		
	}
</script>

<style type="text/css">
	.roller{
		display: flex;
		height: 30px;
		width: 100px;
		border:1px solid #ccc;
	}

	.roller input{
		width: 35px;
		padding-left: 5px;
		margin:0px;
		height: 28px;
		border:none;
		text-align: center;
	}

	select{
		width: 35px;
		padding-left: 5px;
		margin:0px;
		height: 28px;
		border:none;
		text-align: center;
	}

	.roller-column{
		flex:1;
		padding: 0px;
		margin:0px;
	}

	.roller-column button{
		width: 100%;
		height: 100%;
		border:none;
		background-color: transparent;
	}

	strong{
		font-size: 18px;
	}
</style>