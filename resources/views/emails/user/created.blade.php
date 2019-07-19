<body>
    <p>{{__('user.mail.create.welcome')}} <strong>{{$names.' '.$lastnames}}</strong></p>
    <hr/>
    <p>
        {{__('user.mail.create.introduction')}}
    </p>
    <hr/>
    <p>{{__('user.mail.create.info')}}</p>
    <table>
        <thead>
            <th>{{__('user.username')}}</th>
            <th>{{__('user.password')}}</th>
        </thead>
        <tbody>
            <tr>
                <td>{{$username}}</td>
                <td>{{$password}}</td>
            </tr>
        </tbody>
    </table>
    <hr/>
    <p>{{__('user.mail.create.selfinfo')}}</p>
    <p><strong>{{__('user.document')}}</strong> {{$document}}</p>
    <p><strong>{{__('user.address')}}</strong> {{$address}}</p>
    <p><strong>{{__('user.phone')}}</strong> {{$phone}}</p>
    <p><strong>{{__('user.birthday')}}</strong>  {{$birthday}}</p>
    <hr/>
    <p>{{__('user.mail.create.footer')}}</p>
</body>