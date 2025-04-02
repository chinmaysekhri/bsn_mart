<div :class="{'dark text-white-dark' : $store.app.semidark}">
   <nav
      x-data="sidebar"
      class="sidebar fixed top-0 bottom-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300"
      >
      <div class="h-full bg-white dark:bg-[#0e1726]">
         <div class="flex items-center justify-between px-4 py-3">
            <a href="{{route('dashboard')}}" class="main-logo flex shrink-0 items-center">
            <img class="ml-[5px] w-8 flex-none" src="{{ asset('admin/assets/images/logo.png') }}" alt="image" style="width:  158px"/>
            <span class="align-middle text-2xl font-semibold ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light lg:inline"></span>
            </a>
            <a
               href="javascript:;"
               class="collapse-icon flex h-8 w-8 items-center rounded-full transition duration-300 hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10"
               @click="$store.app.toggleSidebar()"
               >
               <svg class="m-auto h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                     opacity="0.5"
                     d="M16.9998 19L10.9998 12L16.9998 5"
                     stroke="currentColor"
                     stroke-width="1.5"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     />
               </svg>
            </a>
         </div>
         <ul
            class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold"
            x-data="{ activeDropdown: 'dashboard' }" x-data="{ activeDropdown: 'User' }">
            <!--Dashboard--->
            <li class="menu nav-item">
               <button
                  type="button"
                  class="nav-link group"
                  :class="{'active' : activeDropdown === 'dashboard'}"
                  @click="activeDropdown === 'dashboard' ? activeDropdown = null : activeDropdown = 'dashboard'"
                  >
                  <div class="flex items-center">
                     <svg
                        class="shrink-0 group-hover:!text-primary"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        >
                        <path
                           opacity="0.5"
                           d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                           fill="currentColor"
                           />
                        <path
                           d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z"
                           fill="currentColor"
                           />
                     </svg>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Dashboard</span>
                  </div>
                  <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'dashboard'}">
                     <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                  </div>
               </button>
               <ul x-cloak x-show="activeDropdown === 'dashboard'" x-collapse class="sub-menu text-gray-500">
                  <li>
                     <a href="https://www.bsnmart.com/" target="_blank" class="active">Visit Website</a>
                  </li>
               </ul>
            </li>
            <!--Dashboard End--->
            <!--My Profile--->
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
               </svg>
               <span>My Profile</span>
            </h2>
            <li class="nav-item">
               <ul>
                  @if(Auth::user()->for == 'normal_user' || empty(Auth::user()->for))
                  <li class="nav-item">
                     <a href="{{route('view_profile')}}" class="group">
                        <div class="flex items-center">
                             <i class="fas fa-registered fa-fw"></i>
                          <!--  <img src="{{asset('public/uploads/users/profile/i_1.png')}}" alt="dashboard.jpg" style="width:8%;">-->
                           <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My Detail</span>
                        </div>
                     </a>
                  </li>
                  @endif
                  @if(Auth::user()->for == 'company')
                  <li class="nav-item">
                     <a href="{{route('company_profile')}}" class="group">
                        <div class="flex items-center">
                            <i class="fas fa-registered fa-fw"></i>
                           <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My Detail</span>
                        </div>
                     </a>
                  </li>
                  @endif
                  @if(Auth::user()->for == 'employee')
                  <li class="nav-item">
                     <a href="{{route('employee_profile')}}" class="group">
                        <div class="flex items-center">
                            <i class="fas fa-registered fa-fw"></i>
                           <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My Detail</span>
                        </div>
                     </a>
                  </li>
                  @endif
                  @if(Auth::user()->for == 'customer')
                  <li class="nav-item">
                     <a href="{{route('customer_profile')}}" class="group">
                        <div class="flex items-center">
                        <i class="fas fa-registered fa-fw"></i>
                           <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My Detail</span>
                        </div>
                     </a>
                  </li>
                  @endif
                  @if(Auth::user()->for == 'seller')
                  <li class="nav-item">
                     <a href="{{route('seller_profile')}}" class="group">
                        <div class="flex items-center">
                            <i class="fas fa-registered fa-fw"></i>
                           <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My Detail</span>
                        </div>
                     </a>
                  </li>
                  @endif
                  @if(Auth::user()->for == 'buyer')
                  <li class="nav-item">
                     <a href="{{route('buyer_profile')}}" class="group">
                        <div class="flex items-center">
                            <i class="fas fa-registered fa-fw"></i>
                           <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My Detail</span>
                        </div>
                     </a>
                  </li>
                  @endif
               </ul>
            </li>
            <!--My Profile  End --->
            <!--User Management--->
             @canany(['role-list', 'designation-list','employee-list','seller-list','buyer-list'])
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
               </svg>
               <span>User Management</span>
            </h2>
            @can('role-list')   
            <li class="menu nav-item">
               <a href="{{route('roles.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fas fa-registered fa-fw"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Role</span>
                  </div>
               </a>
            </li>
            @endcan
            @can('designation-list') 
            <li class="menu nav-item">
               <a href="{{route('designations.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fas fa-registered fa-fw"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Designation</span>
                  </div>
               </a>
            </li>
            @endcan
            @can('employee-list') 
            <li class="menu nav-item">
               <a href="{{route('employees.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-user-tie fa-fw"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Employee</span>
                  </div>
               </a>
            </li>
            @endcan
            @can('seller-list')
            <li class="menu nav-item">
               <a href="{{route('sellers.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-user-plus fa-fw"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Seller</span>
                  </div>
               </a>
            </li>
            @endcan
            @can('buyer-list')
            <li class="menu nav-item">
               <a href="{{route('buyers.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-user-group fa-fw"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Buyer</span>
                  </div>
               </a>
            </li>
            @endcan
            @endcanany
			
            @can('task-list')
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Task Management</span>
            </h2>
            <li class="menu nav-item">
               <a href="{{route('tasks.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa fa-tasks" aria-hidden="true"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Task</span>
                  </div>
               </a>
            </li>
            @endcan 
        
          <?php /* <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Share My Product</span>
            </h2>
            <li class="menu nav-item">
               <a href="{{route('share_my_product')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa fa-tasks" aria-hidden="true"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Share My Product</span>
                  </div>
               </a>
            </li> */ ?>
            
           
            @canany(['prospective-seller-list','sellerapplication-list'])
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Seller</span>
            </h2>
             @can('prospective-seller-list')
            <li class="menu nav-item">
               <a href="{{route('prospectivesellers.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa fa-list-alt" aria-hidden="true"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Prospective Seller </span>
                  </div>
               </a>
            </li>
           @endcan 
             @can('sellerapplication-list')
            <li class="menu nav-item">
               <a href="{{route('sellerapplications.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Seller Application</span>
                  </div>
               </a>
            </li>
              @endcan 
               @endcanany

               @canany(['prospective-buyer-list','buyerapplication-list'])
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Buyer</span>
            </h2>
             @can('prospective-buyer-list')
            <li class="menu nav-item">
               <a href="{{route('prospectivebuyers.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fab fa-product-hunt"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Prospective Buyer</span>
                  </div>
               </a>
            </li>
               @endcan 
                @can('buyerapplication-list')
                <li class="menu nav-item">
               <a href="{{route('buyerapplications.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Buyer Application</span>
                  </div>
               </a>
            </li>
            @endcan 
            @endcanany
            
            @canany(['category-list', 'subcategory-list'])
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Category</span>
            </h2>
             @can('category-list')
            <li class="menu nav-item">
               <a href="{{route('categories.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa fa-list-alt" aria-hidden="true"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Category </span>
                  </div>
               </a>
            </li>
            @endcan 
            @can('subcategory-list')
            <li class="menu nav-item">
               <a href="{{route('subcategories.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fab fa-product-hunt"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Sub-Category </span>
                  </div>
               </a>
            </li>
            @endcan 
            @endcanany

            @canany(['product-list', 'order-list'])
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Product & Order</span>
            </h2>
             @can('product-list')
            <li class="menu nav-item">
               <a href="{{route('product_list')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa fa-search" aria-hidden="true"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Search Product</span>
                  </div>
               </a>
            </li>
             @endcan
             @can('product-list')
              <li class="menu nav-item">
               <a href="{{route('cart')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-basket-shopping"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Cart</span>
                  </div>
               </a>
            </li>
             @endcan
			 
             @can('order-list')
             <li class="menu nav-item">
               <a href="{{route('orders.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Order</span>
                  </div>
               </a>
            </li>
            @endcan 
            @can('order-list')
             <li class="menu nav-item">
               <a href="{{route('my_product_order')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My Product(B/S)</span>
                  </div>
               </a>
            </li>
            @endcan 
            @endcanany
			
			@if(Auth::user()->for != 'buyer')
            @canany(['product-list', 'seller-order-list'])
			
             <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Seller Product & Order</span>
            </h2>
              @can('product-list')
            <li class="menu nav-item">
               <a href="{{route('products.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fab fa-product-hunt"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Product</span>
                  </div>
               </a>
            </li>
            @endcan 
             @can('seller-order-list')
            <li class="menu nav-item">
               <a href="{{route('seller_order')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-basket-shopping"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Seller Order</span>
                  </div>
               </a>
            </li>
           @endcan 
           @endcanany
           @endif
           
            <!--  <li class="menu nav-item">
               <a href="#" class="nav-link group">
                   <div class="flex items-center">
                       <i class="fa-solid fa-basket-shopping"></i>
                       <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My Product(S)</span>
                   </div>
               </a>
               </li>-->
                @canany(['transportaddresse-list', 'sellertransportaddresse-list'])
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Shipping Address</span>
            </h2>
             @can('transportaddresse-list')
        
            <li class="menu nav-item">
               <a href="{{route('transportaddresses.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Buyer Shipping Address</span>
                  </div>
               </a>
            </li>
            @endcan 
            @can('sellertransportaddresse-list')
            <li class="menu nav-item">
               <a href="{{route('sellertransportaddresses.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Seller Shipping Address</span>
                  </div>
               </a>
            </li>
            @endcan
            @endcanany 

             @canany(['wallet-list', 'fund-list'.'withdraw-list'])
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Wallet </span>
            </h2>
            @can('wallet-list')
            <li class="menu nav-item">
               <a href="{{route('wallets.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Wallet</span>
                  </div>
               </a>
            </li>
            @endcan 
            @can('fund-list')
           
            <li class="menu nav-item">
               <a href="{{route('funds.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Funds</span>
                  </div>
               </a>
            </li>
            @endcan 
            @can('withdraw-list')
      
            <li class="menu nav-item">
               <a href="{{route('withdraws.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa-solid fa-handshake"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Withdrawal</span>
                  </div>
               </a>
            </li>
            @endcan 
            @endcanany
			
           @canany(['purchases-list','purchasereturn-list'])
            <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
               <svg
                  class="hidden h-5 w-4 flex-none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="1.5"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  >
                  <line x1="5" y1="12" x2="19" y2="12"></line>
               </svg>
               <span>Purchase</span>
            </h2>
            @can('purchases-list')
            <li class="menu nav-item">
               <a href="{{route('purchases.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Purchase</span>
                  </div>
               </a>
            </li>
			@endcan 
			@can('purchasereturn-list')
             <li class="menu nav-item" style="margin-bottom:50px !important;">
               <a href="{{route('purchasereturns.index')}}" class="nav-link group">
                  <div class="flex items-center">
                     <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                     <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Manage Purchase Return</span>
                  </div>
               </a>
            </li>
			@endcan
			@endcanany
			
         </ul>
      </div>
   </nav>
</div>