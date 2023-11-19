{{> admin_header}}

       <!--start content-->
       <main class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Tables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Data Table</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">DataTable Example</h6>
				<hr/>
				
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr style="text-align: center;background:#04364A;color:white;" >
                                        <th>Inlay</th>
										<th>Song Title</th>
										<th>Content Type</th>
										<th>ISRC</th>
										<th>UPC</th>
										<th>Uploaded On</th>
										<th>Status</th>
                                        <th>Action</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
									{{#each data}}
									<tr style="text-align: center;">
                                        <td><img src="/images/tripura_ashok.png" style="height: 30px;"></td>
										<td>{{song_title}}</td>
										<td>{{content_type}}</td>
										<td>{{song_isrc}}</td>
										<td style="background-color: #A2FF86;">{{content_upc}}</td>
										<td>{{content_createdAt}}</td>
										<td><button type="submit" name="sub" class="btn btn-secondary px-2 rounded-0">{{content_status}}</button></td>
                                        <td><a href="/user/v1/song_edit?Id={{content_id}}" class="btn btn-info px-2 rounded-0">Edit</a></td>
                                        <td><a href="/user/v1/song_edit?Id={{content_id}}" class="btn btn-danger px-2 rounded-0">Delete</a></td>

									</tr>
									{{/each}}
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</main>
       <!--end page main-->

{{>admin_footer}}