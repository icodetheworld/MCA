
   <!DOCTYPE html>
   <html lang="en">
      <head>
         <title>School Master Pro - Login</title>
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <link href="{{asset('/css/log.css')}}" rel='stylesheet' type='text/css' media="all">
         <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
      </head>
      <body>
   <body>
         <div class="mid-class">
            <div class="art-right-sas">   
                <h1 style="color:white;">Cherupushpam English Medium School | Kollam</h1>
                <div class="clear"></div>
                <hr>
                <div class="clear"></div>
                <h2>Sign In </h2>
               <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="main">
                     <div class="form-left-to-w3l">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <span style="color:red">{{ $message }}</span>
                                </span>
                            @enderror
                        <input type="text" name="email" id="email" placeholder="Username" value="{{ old('email') }}" required autocomplete="email" autofocus>        
                     </div>
                     <div class="form-left-to-w3l ">
                        <input type="password"  placeholder="Password"  name="password" required autocomplete="current-password">
                        <div class="clear"></div>
                     </div>
                  </div>
                  <div class="btnn">
                     <button type="submit">Sign In</button>
                  </div>
               </form>
            </div>
            <div class="art-left-sas">
               <h1 class="header-sas" >
                  School Master Pro <br> 1.0
                  <br>
               </h1>
            </div>
         </div>
      </body>
   </html>