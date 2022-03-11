
public class DLinkedList 
{
	private Node head, tail;
	private long size;
	
	public DLinkedList()
	{
		this.head = new Node(null, null, this.tail);
		this.tail = new Node(null, this.head, null);
		this.size = 0;
	}
	
	public void addLast(String data)
	{
		Node nn = new Node(data, null, null);
		
		if(this.size == 0)
		{
			nn.setNext(this.tail);
			nn.setPrev(this.head);
			this.head.setNext(nn);
			this.tail.setPrev(nn);
		}
		else
		{
			nn.setNext(this.tail);
			nn.setPrev(this.tail.getPrev());
			this.tail.getPrev().setNext(nn);
			this.tail.setPrev(nn);
		}
		this.size++;
	}
	
	public void quickSort(Node left, Node right)
	{
		if(right != null && left != right && left != right.getNext())
		{
			Node pivotNode = this.partition(left, right);
			this.quickSort(left, pivotNode = pivotNode.getPrev());
			this.quickSort(pivotNode = pivotNode.getNext(), right);
		}
		
	}
	
	public Node partition(Node left, Node right)
	{
		Node pivot = right, index = left;
		
		for(Node cur = left; cur != right; cur = cur.getNext())
		{
			if(cur.getData().compareTo(pivot.getData()) <= 0)
			{
				swap(index, cur);
				Node temp = cur;
				cur = index;
				index = temp;
				index = index.getNext();
			}
		}
		
		swap(index, pivot);
		return index;
	}
	
	public void swap(Node pos1, Node pos2)
	{
		Node lpos1 = pos1.getPrev(), rpos1 = pos1.getNext(), lpos2 = pos2.getPrev(), rpos2 = pos2.getNext();
		if(this.size == 0 || this.size == 1)
		{
			return;
		}
		if(pos1 == pos2)
		{
			return;
		}
		
		if(pos1.getNext() == pos2)
		{
			lpos1.setNext(pos2);
			pos2.setPrev(lpos1);
			pos2.setNext(pos1);
			rpos2.setPrev(pos1);
			pos1.setNext(rpos2);
			pos1.setPrev(pos2);
		}
		else if(pos1.getPrev() == pos2)
		{
			lpos2.setNext(pos1);
			pos1.setPrev(lpos2);
			pos1.setNext(pos2);
			rpos1.setPrev(pos2);
			pos2.setNext(rpos1);
			pos2.setPrev(pos1);
		}
		else
		{
			lpos1.setNext(pos2);
			pos2.setPrev(lpos1);
			rpos1.setPrev(pos2);
			pos2.setNext(rpos1);
			
			lpos2.setNext(pos1);
			pos1.setPrev(lpos2);
			rpos2.setPrev(pos1);
			pos1.setNext(rpos2);
		}
	}
	
	public void printList()
	{
		Node cur = this.head.getNext();
		
		while(cur.getNext() != null)
		{
			System.out.println(cur.getData());
			cur = cur.getNext();
		}
	}
	
	public Node getFirst() {return this.head.getNext();}
	public Node getLast() {return tail.getPrev();}
}
