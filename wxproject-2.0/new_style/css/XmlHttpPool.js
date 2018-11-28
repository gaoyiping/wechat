var __XmlHttpPool__ =
{
	m_MaxPoolLength : 10,
	m_XmlHttpPool : [],
	m_IsCancel : false,
	
	__requestObject : function()
	{
		var xmlhttp = null;
		var pool = this.m_XmlHttpPool;
		for ( var i=0 ; i < pool.length ; ++i )
		{
			if ( pool[i].readyState == 4 || pool[i].readyState == 0 )
			{
				xmlhttp = pool[i];
				break;
			}
		}
		if ( xmlhttp == null )
		{
			return this.__extendPool();
		}
		return xmlhttp;
	},

__extendPool: function (charSet) {
      
		if ( this.m_XmlHttpPool.length < this.m_MaxPoolLength )
		{
        var xmlhttp_request = false;    
        try
        {        
            if( window.ActiveXObject )//IE
            {            
                for( var i = 5; i; i-- )
                {               
                    try
                    {                   
                        if( i == 2 )
                        {
                            xmlhttp_request = new ActiveXObject( "Microsoft.XMLHTTP" );                       
                        }
                        else
                        {
                            xmlhttp_request = new ActiveXObject( "Msxml2.XMLHTTP." + i + ".0" );    
                            xmlhttp_request.setRequestHeader("Content-Type","text/xml");
                            if((charSet != null) && (charSet != ""))
                            {
                                xmlhttp_request.setRequestHeader("Content-Type",charSet);   
                            }             
                        }
                        break;
                    }               
                    catch(e) {   
                        xmlhttp_request = false;              
                    }          
                }       
            }
            else if( window.XMLHttpRequest )//FireFox
            {            
                xmlhttp_request = new XMLHttpRequest();           
                if (xmlhttp_request.overrideMimeType) 
                {                
                    xmlhttp_request.overrideMimeType('text/xml');            
                }       
            }   
        }
        catch(e)
        {        
            xmlhttp_request = false;   
        } 
       if (xmlhttp_request )
		{
			this.m_XmlHttpPool.push(xmlhttp_request);
		}
        return xmlhttp_request;
	  }
	},
	
	GetRemoteData : function(url, callback)
	{
		if ( url && url.length > 2000 )
		{
			var pos = url.indexOf('?');
			var data = url.substr(pos+1);
			url = url.substring(0, pos);
			return this.PostRemoteData(url, callback, data);
		}
		else
		{
			return this.__receiveRemoteData(url, callback, 'GET', null);
		}
	},
	
	PostRemoteData : function(url, callback, data)
	{
		return this.__receiveRemoteData(url, callback, 'POST', data);
	},
	
	__receiveRemoteData : function(url, callback, httpmethod, data)
	{
		var xmlhttp = this.__requestObject();
		if ( !xmlhttp ) {
		    return null;
		}
		xmlhttp.open(httpmethod, url, true);
		if ( httpmethod == 'POST' )
		{
			xmlhttp.setRequestHeader("Content-Length", data.length);
			xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		}
		xmlhttp.onreadystatechange = function()
		{
			if ( xmlhttp.readyState == 4 || xmlhttp.readyState == 'complete' )
			{
				if ( !__XmlHttpPool__.m_IsCancel )
				{
					try
					{
						callback(xmlhttp.responseText);
					}
					catch(e)
					{
						if ( (e.number & 0xFFFF) == 5011 )
						{
							// 错误: 不能执行已释放 Script 的代码

							return null;
						}
						__Debug__(e, xmlhttp.responseText);
					}
				}
			}
		};
		xmlhttp.send(data);
		return xmlhttp;
	},
	
	GetRemoteDataEx : function(url)
	{
		if ( url && url.length > 2000 )
		{
			var pos = url.indexOf('?');
			var data = url.substr(pos+1);
			url = url.substring(0, pos);
			return this.PostRemoteDataEx(url, data);
		}
		else
		{
			return this.__receiveRemoteDataEx(url, 'GET', null);
		}
	},
	
	PostRemoteDataEx : function(url, data)
	{
		return this.__receiveRemoteDataEx(url, 'POST', data);
	},
	
	__receiveRemoteDataEx : function(url, httpmethod, data)
	{
		var xmlhttp = this.__requestObject();
		if ( !xmlhttp )
		{
			return null;
		}
		xmlhttp.open(httpmethod, url, false);
		if ( httpmethod == 'POST' )
		{
			xmlhttp.setRequestHeader("Content-Length", data.length);
			xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		}
		try
		{
			xmlhttp.send(data);
		}
		catch(e)
		{
			__Debug__(e, data);
		}

		if ( xmlhttp.status == 200 )
		{
			return xmlhttp.responseText;
		}
		return '';
	},
	
	CancelAll : function()
	{
		this.m_IsCancel = true;
		var extendPool = this.__extendPool;
		this.__extendPool = function()
		{
			return null;
		}
		for ( var i=0 ; i < this.m_XmlHttpPool.length ; ++i )
		{
			this.m_XmlHttpPool.onreadystatechange = function()
			{
				return false;
			};
			this.m_XmlHttpPool[i].abort();
		}
		this.__extendPool = extendPool;
	}	
};