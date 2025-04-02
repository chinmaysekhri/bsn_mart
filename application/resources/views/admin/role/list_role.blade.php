@extends('admin.layouts.app')
@section('title','Role List')
@section('content')

<div x-data="multipleTable">
   <div class="panel">
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">Table 1</h5>
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="dataTable-top">
            <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
         </div>
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table">
               <thead>
                  <tr>
                     <th data-sortable="" style="width: 18.5814%;" class=""><a href="#" class="dataTable-sorter">Name</a></th>
                     <th data-sortable="" style="width: 12.0879%;" class="desc"><a href="#" class="dataTable-sorter">Company</a></th>
                     <th data-sortable="" style="width: 8.59141%;"><a href="#" class="dataTable-sorter">Age</a></th>
                     <th data-sortable="" style="width: 12.7872%;"><a href="#" class="dataTable-sorter">Start Date</a></th>
                     <th data-sortable="" style="width: 22.977%;"><a href="#" class="dataTable-sorter">Email</a></th>
                     <th data-sortable="" style="width: 15.4845%;"><a href="#" class="dataTable-sorter">Phone No.</a></th>
                     <th data-sortable="" style="width: 11.5884%;"><a href="#" class="dataTable-sorter">Status</a></th>
                     <th data-sortable="false" style="width: 7.39261%;">
                        <div class="text-center">Action</div>
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-11.jpeg">Odom Mills</div>
                     </td>
                     <td>ZORROMOP</td>
                     <td>34</td>
                     <td>24/01/2010</td>
                     <td>odommills@memora.com</td>
                     <td>+1 (995) 525-3402</td>
                     <td><span class="badge bg-success">SUCCESS</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-16.jpeg">Little Hatfield</div>
                     </td>
                     <td>ZIDANT</td>
                     <td>33</td>
                     <td>03/01/2012</td>
                     <td>littlehatfield@comtract.com</td>
                     <td>+1 (812) 488-3011</td>
                     <td><span class="badge bg-warning">CANCEL</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-22.jpeg">Carmella Mccarty</div>
                     </td>
                     <td>ZEDALIS</td>
                     <td>21</td>
                     <td>06/03/1980</td>
                     <td>carmellamccarty@sybixtex.com</td>
                     <td>+1 (876) 456-3218</td>
                     <td><span class="badge bg-success">FAILED</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-14.jpeg">Sophie Horn</div>
                     </td>
                     <td>XTH</td>
                     <td>22</td>
                     <td>20/09/2018</td>
                     <td>sophiehorn@snorus.com</td>
                     <td>+1 (885) 418-3948</td>
                     <td><span class="badge bg-warning">CANCEL</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-4.jpeg">Daisy Whitley</div>
                     </td>
                     <td>VOLAX</td>
                     <td>21</td>
                     <td>23/03/1987</td>
                     <td>daisywhitley@applideck.com</td>
                     <td>+1 (861) 564-2877</td>
                     <td><span class="badge bg-info">APPROVED</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-21.jpeg">Frank Hays</div>
                     </td>
                     <td>SYBIXTEX</td>
                     <td>31</td>
                     <td>15/06/2005</td>
                     <td>frankhays@illumity.com</td>
                     <td>+1 (930) 577-2670</td>
                     <td><span class="badge bg-success">SUCCESS</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-17.jpeg">Larson Kelly</div>
                     </td>
                     <td>SUREPLEX</td>
                     <td>20</td>
                     <td>14/06/2010</td>
                     <td>larsonkelly@zidant.com</td>
                     <td>+1 (892) 484-2162</td>
                     <td><span class="badge bg-warning">SUCCESS</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-13.jpeg">Wendi Powers</div>
                     </td>
                     <td>SNORUS</td>
                     <td>31</td>
                     <td>02/06/1979</td>
                     <td>wendipowers@orboid.com</td>
                     <td>+1 (863) 457-2088</td>
                     <td><span class="badge bg-warning">FAILED</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-9.jpeg">Marva Sandoval</div>
                     </td>
                     <td>QUILCH</td>
                     <td>28</td>
                     <td>02/11/2010</td>
                     <td>marvasandoval@avit.com</td>
                     <td>+1 (927) 566-3600</td>
                     <td><span class="badge bg-secondary">COMPLETE</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="flex items-center w-max"><img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="admin/assets/images/profile-1.jpeg">Caroline Jensen</div>
                     </td>
                     <td>POLARAX</td>
                     <td>39</td>
                     <td>28/05/2004</td>
                     <td>carolinejensen@zidant.com</td>
                     <td>+1 (821) 447-3782</td>
                     <td><span class="badge bg-warning">SUCCESS</span></td>
                     <td>
                        <div class="text-center">
                           <button type="button" x-tooltip="Delete">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                 <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle>
                                 <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              </svg>
                           </button>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="dataTable-bottom">
            <div class="dataTable-info">Showing 1 to 10 of 25 entries</div>
            <div class="dataTable-dropdown">
               <label>
                  <select class="dataTable-selector">
                     <option value="10" selected="">10</option>
                     <option value="20">20</option>
                     <option value="30">30</option>
                     <option value="50">50</option>
                     <option value="100">100</option>
                  </select>
               </label>
            </div>
            <nav class="dataTable-pagination">
               <ul class="dataTable-pagination-list">
                  <li class="pager">
                     <a href="#" data-page="1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                           <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                     </a>
                  </li>
                  <li class="active"><a href="#" data-page="1">1</a></li>
                  <li class=""><a href="#" data-page="2">2</a></li>
                  <li class=""><a href="#" data-page="3">3</a></li>
                  <li class="pager">
                     <a href="#" data-page="2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                           <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                     </a>
                  </li>
                  <li class="pager">
                     <a href="#" data-page="3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
                           <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
   </div>
</div>



@endsection