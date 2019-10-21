@if($team->localInvoices->where('provider_id', 'manual')->count() > 0)
	<div class="card card-default">
	    <div class="card-header">{{__('Other Invoices')}}</div>

	    <div class="table-responsive">
	        <table class="table">
	            <thead>
	            </thead>
	            <tbody>
	            	@foreach($team->localInvoices->where('provider_id', 'manual') as $invoice)
		            	<tr>
		            		<td>

		            			<strong>{{$invoice->created_at->format('F jS, Y')}}</strong>
		            		</td>
		            		<td>
		                        ${{number_format($invoice->total, 2)}}
		                    </td>
		                    <td class="text-right">
		                    	<a href="/settings/teams/{{$team->id}}/invoice-new/{{$invoice->id}}">
		                    		<button class="btn btn-default"><i class="fa fa-btn fa-file-pdf-o"></i> Download PDF</button>
		                    	</a>
		                    </td>
		                </tr>
	                @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>
@endif