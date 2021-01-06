
    <?php
        if(auth::check()){
            $carrito = DB::table('carrito as c')
            ->join('producto as p','c.idproducto','=','p.id')
            ->select('c.cantidad','p.poster','p.titulo','p.precio_ahora','c.id')
            ->where('iduser','=',auth()->user()->id)
            ->orderby('c.id','desc')
            ->limit(2)
            ->get();
            $carrito_total = DB::table('carrito')
            ->where('iduser','=',auth()->user()->id)
            ->get();
            $num_compras = count($carrito_total);
        }
        $config = DB::table('configuraciones')
        ->first();
    ?>
                    <div class="navbar" style="background: #0033FF">
                        <div class="container">
                            <div class="header-left">
                                <a href="{{route('inicio')}}" class="logo">
                                <img src="{{asset('config/'.$config->logo)}}" alt="devctheme Logo" width="160" hesight="100">
                                </a>
                            </div><!-- End .header-left -->
        
                            <div class="header-center">
                                <div class="header-search">
                                    <a class="search-toggle" role="button"> <p class="small text-center text-light">Buscar <i class="icon-magnifier text-light"></i></p></a>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                        <div class="header-search-wrapper">
                                            
                                            
                                            <input type="search" class="small form-control" placeholder="Buscar por producto,marca o categoria." name="buscar"  required>
                                            
                                            
                                            
                                            <button class="btn" type="submit" type="submit"><i class="icon-magnifier"></i></button>
                                        </div><!-- End .header-search-wrapper -->
                                    {{Form::close()}}
                                </div><!-- End .header-search -->
                            </div><!-- End .headeer-center -->
        
                            <div class="header-right">
                                <button class="mobile-menu-toggler" type="button">
                                    <i class="icon-menu"></i>
                                </button>
                                <div class="header-contact">
                                    <span>Llamanos</span>
                                    <a href="tel:#"><strong>{{$config->telefono}}</strong></a>
                                </div><!-- End .header-contact -->
        
        
                               @if (Auth::check())
                             
                                    <div   class="dropdown cart-dropdown" >
                                        <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                            <span class="cart-count"><?php echo $num_compras?></span>
                                        </a>
                                        
                                        <div class="dropdown-menu" >
                                            <div class="dropdownmenu-wrapper">
                                                <div class="dropdown-cart-products">
                                                    
                                                    @if (count($carrito)>0)
                                                        @foreach ($carrito as $item)
                                                            <div class="product">
                                                                <div class="product-details">
                                                                    <h4 class="product-title">
                                                                        <a href="product.html">{{$item->titulo}}</a>
                                                                    </h4>
        
                                                                    <span class="cart-product-info">
                                                                        <span class="cart-product-qty">{{$item->cantidad}}</span>
                                                                        = S/<?php echo $item->precio_ahora * $item->cantidad?>
                                                                    </span>
                                                                </div><!-- End .product-details -->
        
                                                                <figure class="product-image-container">
                                                                    <a href="product.html" class="product-image">
                                                                        <img src="{{asset('poster/'.$item->poster)}}" alt="product">
                                                                    </a>
                                                                    <form action="{{route('quitar.carrito',$item->id)}}" method="POST" style="margin-bottom: 0px !important; cursor:pointer">
                                                                        @csrf
                                                                
                                                                        <input name="_method" type="hidden" value="DELETE">
                                                                        <button type="submit" class="btn-remove"  title="Eliminar producto"><i class="icon-cancel"></i></button>
                                                                    </form>
                                                                    
                                                                </figure>
                                                            </div><!-- End .product -->
                                                        @endforeach
                                                    @else
                                                        <div class="product">
                                                            <div class="product-details">
                                                                <h4>Carrito vacio :(</h4>
                                                            </div>
                                                        </div>
                                                    @endif
        
                                                    
                                                </div><!-- End .cart-product -->
        
                                              
        
                                                <div class="dropdown-cart-action" style="margin-top:8px">
                                                    <a href="{{route('carrito')}}" class="btn">Ver carrito</a>   
                                                </div><!-- End .dropdown-cart-total -->
                                            </div><!-- End .dropdownmenu-wrapper -->
                                        </div><!-- End .dropdown-menu -->
                                        
                                    </div><!-- End .dropdown -->
                          
                               @endif
                            </div><!-- End .header-right -->
                        </div><!-- End .container -->
                    </div><!-- End .header-middle -->