function validAngka(a)
{
	if(!/^[0-9]+$/.test(a.value))
	{
	a.value = a.value.substring(0,a.value.length-1000);
	}
}

function validHuruf(a)
{
	if(!/^[a-z., A-Z]+$/.test(a.value))
	{
	a.value = a.value.substring(0,a.value.length-1000);
	}

	}
