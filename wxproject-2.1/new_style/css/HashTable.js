// JScript 文件

function HashTable() 
        {         
                this.Items=[]; 
                this.Count=function(){return this.Items.length;};        //长度                 
                this.DictionaryEntry=function(key,value) 
                { 
                        this.Key=key||null; 
                        this.Value=value||null; 
                } 
                this.Add=function(key,value){this.Items.push(new this.DictionaryEntry(key,value));} 
                this.Clear=function(){this.Items.length=0;} 
                this.Remove=function(key) 
                { 
                        var index=this.GetIndexWithKey(key); 
                        if(index>-1)
                            this.Items.splice(index,1); 
                } 
                this.GetValue=function(key) 
                { 
                        var index=this.GetIndexWithKey(key); 
                        if(index>-1)
                            return this.Items[index].Value; 
                } 
                this.ContainsKey=function(key) 
                { 
                        if(this.GetIndexWithKey(key)>-1)
                            return true; 
                        return false; 
                } 
                this.ContainsValue=function(value) 
                { 
                        if(this.GetIndexWithValue(value)>-1)
                            return true; 
                        return false; 
                } 
                this.Keys=function() 
                { 
                        var iLen=this.Count(); 
                        var resultArr=[]; 
                        for(var i=0;i<iLen;i++)
                            resultArr.push(this.Items[i].Key); 
                        return resultArr; 
                } 
                this.Values=function() 
                { 
                        var iLen=this.Count(); 
                        var resultArr=[]; 
                        for(var i=0;i<iLen;i++) 
                            resultArr.push(this.Items[i].Value); 
                        return resultArr; 
                } 
                this.IsEmpty=function(){return this.Count()==0;} 
                this.GetIndexWithKey=function(key) 
                { 
                        var iLen=this.Count(); 
                        for(var i=0;i<iLen;i++)
                            if(this.Items[i].Key===key)
                                return i; 
                        return -1; 
                } 
                this.GetIndexWithValue=function(value) 
                { 
                        var iLen=this.Count(); 
                        for(var i=0;i<iLen;i++)
                            if(this.Items[i].Value===value)
                                return i; 
                        return -1; 
                } 
        } 
//        var my=new HashTable(); 
//        my.Add("name","blueKnight"); 
//        my.Add("age",'24'); 
//        my.Add("sex","boy"); 
//        alert(my.Count());
//        alert(my.ContainsValue("boy"));
//        alert(my.GetValue("name"))
//        for(var i in my.Items) 
//        { 
//             alert("Key:"+my.Items[i].Key+"--Value:"+my.Items[i].Value); 
//        } 
//        my.Remove("age"); 
//        alert(my.Keys()+'-'+my.Values()+'\n\r');    