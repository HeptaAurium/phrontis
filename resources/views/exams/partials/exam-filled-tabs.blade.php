 @php $y = 1; @endphp
 @foreach ($branches as $branch)
     @cannot('can_all')
         @if ($branch->id != auth()->user()->branch_id)
             @php continue; @endphp
         @endif
     @endcannot
     <div class="exam-tabs @if ($y==1) active @endif"
         id="exam_tab{{ $branch->id }}">
         <div class="row p-3">
             @foreach ($classes as $item)
                 <table class="table table-sm table-light table-striped table-checked border shadow-sm p-2 my-3">
                     <thead>
                         <tr>
                             <th class="text-left border-bottom" colspan="{{ count($subjects) + 1 }}">
                                 {{ $item->name }}
                             </th>
                         </tr>
                         <tr class="py-4">
                             <th class="border py-3">Exam Type</th>
                             @foreach ($subjects as $sb)
                                 <th class="border py-3">{{ $sb->name }}</th>
                             @endforeach
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($exam_types as $ex)
                             <tr>
                                 <td class="border">{{ $ex->name }}</td>
                                 @foreach ($subjects as $sub)
                                     @php
                                         $filled = \App\Utilities\ExamUtil::check_if_filled($sub->id, $item->id, $ex->id, $branch->id);
                                     @endphp
                                     <td class="text-center border">
                                         @if ($filled)
                                             <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                         @else
                                             <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                         @endif
                                     </td>
                                 @endforeach
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             @endforeach
         </div>
     </div>
     @php $y +=1; @endphp
 @endforeach
