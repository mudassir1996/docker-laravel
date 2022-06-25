<div id="sub-msg" style="transform: translateX(-50%); position: fixed; z-index: 10000; width:100%; max-width: 800px; left: 50%; bottom: 50px; background-color: #050421; padding:5px 10px; border-radius: 6px; box-shadow: 0px 5px 30px rgba(5, 4, 33, 0.3); display: flex;  align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; margin-right: 10px;">
        {{-- <img style="height: 26px; margin-left: 10px; margin-right: 25px; margin-bottom: 2px" src="" alt="">     --}}
        <h1 style=" margin-left: 10px; margin-right: 25px; margin-bottom: 2px; color:#fff; font-family: logo-font; " >MgtOs</h1>
        <div style="color: #FFFFFF; font-size: 14px;">
            <b style="padding-right: 5px;">{!!App\Classes\Subscriber::hasPending()?'Your subscription is under review. Your account will have all premium access within 24 hours. <a href="'.route('subscription.index').'">See here</a>':'You are using free version, Please upgrade to fully functional system.'!!}</b>
            {{-- <span style="opacity: 0.75">With Bootststrap 5, improved documentation and many more amazing features.</span>     --}}
        </div>
    </div>
    <div style="display: flex; align-items: center;">
        @if (!App\Classes\Subscriber::hasPending())
        <a href="#" data-toggle="modal" data-target="#subscription_modal" style="text-decoration: none !important; background-color: #00AB4E; color: #ffffff; font-weight: bold; text-transform: uppercase; padding: 3px 16px 3px 16px; border-radius: 6px; margin-right: 12px;">Upgrade</a>
        @endif
        <a href="javascript:void(0);" style="padding: 6px;" id="kt_metronic_8_engage_dismiss">
            <i class=" text-dark-50 ki ki-close"></i>
        </a>
    </div>
</div>



@include('pages.subscription.subscription-model')

