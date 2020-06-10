<!DOCTYPE html>
<html>
<head>
    <title>{!! config("app.name") !!}</title>
    <style type="text/css">
        .email-text a
        {
            color: #FFFFFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
  <table class="m_-2377898351467431040table-wrapper" style="width:700px;margin:auto;margin-top:50px;border-radius:7px" cellspacing="0" cellpadding="0">
    <tbody>
      <tr>
        <td style="background:#fff;border-bottom-left-radius:6px;border-bottom-right-radius:6px;padding-bottom:40px;margin:0 auto!important;clear:both!important">
            <div class="m_-2377898351467431040header-title" style="background:#006535;color:#ffffff;padding:0px 60px 40px;text-align:center;margin-bottom:40px">
              <h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,&quot;Lucida Grande&quot;,sans-serif;margin-bottom:15px;color:#212121;margin:0px 0 10px;line-height:1.2;font-weight:200;line-height:45px;font-weight:bold;margin-bottom:30px;font-size:28px;line-height:40px;margin-bottom:10px;font-weight:400;color:#ffffff;padding-left:40px;padding-right:40px;padding-top:40px;padding-top:30px">{{ \App\Enhancers\AppHelper::$enquiry_types[$data['type']] }} Enquiry</span>!</h1>

              <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505e;color:#ffffff;opacity:0.8;padding-left:40px;padding-right:40px;margin-bottom:0;padding-bottom:0">{{ ucfirst($data['firstName']).' '.ucfirst($data['lastName']) }} has made a new enquiry.</p>
            </div>

            <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505e;padding-left:40px;padding-right:40px">You can find details about the enquiry below.</p>
            </p>

            <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505e;padding-left:40px;padding-right:40px">   Email: {{ $data['email'] }}.<br>
               Phone Number: {{ $data['phone'] }}.<br>
               Message: {{ $data['message'] }}.
            </p>
            </p>

            <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505e;padding-left:40px;padding-right:40px;margin-bottom:0;padding-bottom:0">Best wishes,<br>
            {!! config("app.name") !!}</p>
        </td>
      </tr>
      <tr>
        <td class="m_-2377898351467431040header" style="border-top-left-radius:6px;border-top-right-radius:6px;height:80px;background:#fff;background-size:300px;background-position:100%;background-repeat:no-repeat;line-height:55px;padding-top:0;text-align:center;color:#ffffff;display:block!important;margin:-130px auto!important;clear:both!important">
            <a href="{{ config("app.url") }}"><img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" style="max-width:100%;border-radius:50%;padding:5px;width: 350px;height: auto;" class="CToWUd"></a>
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>
