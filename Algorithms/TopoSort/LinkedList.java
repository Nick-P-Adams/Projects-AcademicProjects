
public class LinkedList 
{
	private Node head;
	private int size = 0;
	private Boolean visited = false;
	
	private class Node
	{
		int data;
		Node next;
		
		Node(int data)
		{
			this.data = data;
			this.next = null;
		}
	}
	
	public void insert(int data)
	{
		Node nn = new Node(data);
		
		if(this.head == null)
		{
			this.head = nn;
		}
		else
		{
			Node last = this.head;
			
			while(last.next != null)
			{
				last = last.next;
			}
			
			last.next = nn;
		}
		
		this.size++;
	}
	
	public int get(int index)
	{
		Node cur = this.head;
		int count = 0;
		
		while(cur != null)
		{
			if(count == index)
			{
				return cur.data;
			}
			
			count++;
			cur = cur.next;
		}
		
		return 0;
	}
	
	public void printList()
	{
		Node cur = this.head;
		while(cur != null)
		{
			System.out.print(cur.data + " ");
			cur = cur.next;
		}
	}
	
	public void printReverseList()
	{
		Node cur = this.head;
		this.printReverseUtil(cur);
	}
	
	private void printReverseUtil(Node cur)
	{
		if(cur.next != null)
		{
			printReverseUtil(cur.next);
		}
		System.out.print(cur.data + " ");
	}
	
	public int getSize() {return this.size;}
	public Boolean visited() {return this.visited;}
	public void setVisited(Boolean visited) {this.visited = visited;}
}
